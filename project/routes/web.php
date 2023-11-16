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
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\InsightsController;
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
    Route::get('/', [ListingController::class, 'index']);
    
    Route::get('/listings/cart', [ListingController::class, 'cart']);
    Route::post('/listings/{listing}/add-to-cart', [ListingController::class, 'addToCart']);
    Route::delete('/listings/{listing}/remove-from-cart', [ListingController::class, 'removeFromCart']);


    Route::group(['middleware' => ['\App\Http\Middleware\CheckRoleMerchant']], function () {
        // "Create," "Edit," "Update," "Delete," and "Manage" routes
        Route::get('listings/create', [ListingController::class, 'create']);
        Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');
        Route::get('listings/{listing}/edit', [ListingController::class, 'edit']);
        Route::put('/listings/{listing}', [ListingController::class, 'update']);
        Route::delete('/listings/{listing}', [ListingController::class, 'destroy']);
        Route::get('/listings/manage', [ListingController::class, 'manage']);
    });
    
    // Orders Listing
    Route::get('/listings/orders', [ListingController::class, 'orders'])->name('orders');
    Route::get('/listings/orders', [ListingController::class, 'showOrderForm'])->name('order-form');
    Route::post('/listings/orders', [ListingController::class, 'placeOrder'])->name('place-order');

  // Single Listings
Route::get('listings/{listing}', [ListingController::class, 'show']);


Route::group(['middleware' => ['\App\Http\Middleware\CheckRoleAdmin']], function () {
        Route::get('/admin/list', [AdminController::class, 'listUsers']);
        Route::get('/admin/create', [AdminController::class, 'create']); // Create user form
        Route::post('/admin/create', [AdminController::class, 'createUser']); // Create user action
        Route::get('/admin/edit/{id}', [AdminController::class, 'editUserForm'])->name('admin.edit'); // Edit user form
        Route::put('/admin/{id}', [AdminController::class, 'updateUser']); // Update user action
        Route::delete('/admin/{id}', [AdminController::class, 'deleteUser'])->name('admin.destroy');
        Route::put('/admin/{id}', [AdminController::class, 'updateUsers']);
        Route::delete('/admin/{id}', [AdminController::class, 'deleteUsers']);
        Route::get('listings/create', [ListingController::class, 'create']);
        Route::get('listings/{listing}/edit', [ListingController::class, 'edit']);
        Route::put('/listings/{listing}', [ListingController::class, 'update']);
        Route::delete('/listings/{listing}', [ListingController::class, 'destroy']);
        Route::get('/listings/manage', [ListingController::class, 'manage']);
});

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

//BUDGET ROUTES
Route::get('/budget', [BudgetController::class, 'create'])->name('budget.create');
Route::post('/budget', [BudgetController::class, 'store'])->name('budget.store');
Route::get('/pie-chart', [BudgetController::class, 'generateCategoryChart'])->name('pie-chart');
Route::get('/wallet', [BudgetController::class, 'wallet'])->name('wallet');


//CHART
Route::get('/insights', [InsightsController::class, 'show'])->name('insights.show');
Route::get('/chart', [ListingController::class, 'generateTagChart'])->name('chart')->middleware('auth');

//SCRAPER
Route::get('scraper', [ScraperController::class, 'scrapeJumia'])->name('scraper');
Route::get('/{productLink}', [ScraperController::class, 'showProduct']);
