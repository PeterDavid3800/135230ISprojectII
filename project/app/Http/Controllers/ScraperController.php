<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Goutte\Client;


class ScraperController extends Controller
{

    private $results = array();

    public function scraper()
    {
        $client = new Client();
        $url = 'https://www.jumia.co.ke/';

        $page = $client->request('GET', $url);

        
        $data = $page->filter('.your-css-selector')->each(function ($item) {
            // Extract and process the data here.
            $title = $item->filter('.title-selector')->text();
            $price = $item->filter('[data-bbl]:after')->text();
            
            return [
                'title' => $title,
                'price' => $price,
            ];
        });
        return view('scraper', compact('data'));
    }
}
