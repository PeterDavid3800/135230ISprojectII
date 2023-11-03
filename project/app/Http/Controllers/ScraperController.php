<?php
namespace App\Http\Controllers;

use Goutte\Client;
use Spatie\Crawler\Crawler;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\PuppeteerScraperService;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\BrowserKit\HttpBrowser;

class ScraperController extends Controller
{
    public function scrapeJumia()
    {
        // Create a Goutte client to scrape the website
        $client = new Client();
        $crawler = $client->request('GET', 'https://www.jumia.co.ke/');

        // Initialize an empty array to store scraped data
        $scrapedData = [];

        // Extract product data
        $crawler->filter('a.core')->each(function ($node) use (&$scrapedData) {
            $productLink = $node->attr('href');
            $productName = $node->attr('data-name');
            $productPrice = $node->attr('data-price');
            $productBrand = $node->attr('data-brand');
            $productCategory = $node->attr('data-category');

            $productDiscountCrawler = $node->filter('div.bdg._dsct');
            $productDiscount = $productDiscountCrawler->count() > 0 ? $productDiscountCrawler->text() : 'N/A';

            // Extract the image URL
            $imageURL = $node->filter('img.img')->attr('data-src');
            $baseURL = 'https://jumia.co.ke';
            $productLink = $node->attr('href'); // The original product link

            // Combine the base URL and product link to create the complete URL
            $completeProductLink = $baseURL . $productLink;

            $scrapedData[] = [
                'productLink' => $completeProductLink,
                'productName' => $productName,
                'productPrice' => $productPrice,
                'productBrand' => $productBrand,
                'productCategory' => $productCategory,
                'productDiscount' => $productDiscount,
                'imageURL' => $imageURL, // Add the image URL to the scraped data
            ];
        });
        session(['scrapedData' => $scrapedData]);
        // Return the scraped data to the 'scraper' view
        return view('scraper', compact('scrapedData'));
    }

 /*   public function visitWebsite($url)
{
    // Construct the complete URL using the base URL and the product link
    $baseUrl = 'https://jumia.co.ke'; // Replace with the Jumia base URL
    $completeUrl = $baseUrl . $url;

    // Redirect the user to the complete URL
    return redirect()->away($completeUrl);
} */



}