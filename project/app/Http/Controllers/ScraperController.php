<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ScraperController extends Controller
{
    public function scraper()
    {
        return view('scraper');
    }
}
