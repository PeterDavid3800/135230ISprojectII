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
    public function scrapeJumia(Request $request)
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

            //Store data in the array
            $scrapedData[] = [
                'productLink' => $completeProductLink,
                'productName' => $productName,
                'productPrice' => $productPrice,
                'productBrand' => $productBrand,
                'productCategory' => $productCategory,
                'productDiscount' => $productDiscount,
                'imageURL' => $imageURL, 
            ];
        });

        // Filter the scraped data based on the search term
        $searchTerm = $request->input('search');
        if ($searchTerm) {
            $scrapedData = array_filter($scrapedData, function ($item) use ($searchTerm) {
                return stripos($item['productName'], $searchTerm) !== false;
            });
        }

        session(['scrapedData' => $scrapedData]);
        // Return the scraped data to the 'scraper' view
        return view('scraper', compact('scrapedData'));
    }

}