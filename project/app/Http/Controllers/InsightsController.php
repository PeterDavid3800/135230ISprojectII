<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InsightsController extends Controller
{
    public function show()
    {
        return view('insights');
    }
}
