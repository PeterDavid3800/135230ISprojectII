<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Facade;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Models\Listing;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\OrderController;


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
//All Listings
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

//Orders Page
Route::get('/orders/orders', [OrderController::class, 'orders'])->middleware('auth')->name('orders');


//Single Listings
Route::get('listings/{listing}', [ListingController::class, 'show']);

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


//Logging users out
Route::post('/logout', [UserController::class, 'logout']);