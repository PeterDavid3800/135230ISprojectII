<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Facade;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Models\Listing;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ScraperController;
use App\Models\Crawler;
use App\Models\Order;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//ALL LISTING ROUTES

Route::get('/', [ListingController::class, 'index']);

//Show Create Form
Route::get('listings/create', [ListingController::class, 'create'])->middleware('auth');

//Store Listings Data
Route::post('listings', [ListingController::class, 'store']);

//Show Edit Form
Route::get('listings/{listing}/edit', [ListingController::class, 'edit']);

//Update Listing
Route::put('/listings/{listing}', [ListingController::class, 'update']);


//Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

//Manage Listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

//Cart Listing
Route::get('/listings/cart', [ListingController::class, 'cart']);
Route::post('/listings/{listing}/add-to-cart', [ListingController::class, 'addToCart']);
Route::delete('/listings/{listing}/remove-from-cart', [ListingController::class, 'removeFromCart']);

// Orders Listing
Route::get('/listings/orders', [ListingController::class, 'orders'])->middleware('auth')->name('orders');
Route::get('/listings/orders', [ListingController::class, 'showOrderForm'])->name('order-form');
Route::post('/listings/orders', [ListingController::class, 'placeOrder'])->name('place-order');



//Single Listings
Route::get('listings/{listing}', [ListingController::class, 'show']);





//ALL USER AUTH ROUTES
//Showing the register form
Route::get('/register', [UserController::class, 'register'])->middleware('guest');


//Show login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

//Authenticate
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

//Register
//Storing users in database
Route::post('/users', [UserController::class, 'store']);

//2fa
Route::get('/verify-registration-otp', [UserController::class, 'regOTP']);
Route::post('/verify-registration-otp', [UserController::class, 'verifyRegistrationOtp']);
Route::get('/verify-login-otp', [UserController::class, 'logOTP']);
Route::post('/verify-login-otp', [UserController::class, 'verifyLoginOtp']);
//Resend OTP
Route::get('/resend-otp', [UserController::class, 'resendOtp'])->name('resend-otp'); 
Route::get('/resend-registration-otp', [UserController::class, 'resendRegOtp'])->name('resendRegOtp');


// Log User Out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');



//CRAWLER
//Crawler
Route::get('/crawler', function () {
    $items = Crawler::orderBy('status', 'asc')->get();

    return view('crawler', ['items' => $items]);
});

//SCRAPER
Route::get('scraper', [ScraperController::class, 'scraper'])->name('scraper');
