<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace'=>'Front'],function (){

    Route::pattern('price','low-high|high-low');
    Route::get('/', 'HomeController@index')->name('website');
    // for my account
    Route::get('/account', 'AccountController@viewProfile')->name('account')->middleware('auth');
    Route::put('/update-my-account-information', 'AccountController@updateInformation')->name('account.information')->middleware('auth');
    Route::put('/reset-my-account-password', 'AccountController@resetPassword')->name('account.password')->middleware('auth');

    //pages
    Route::get('/contact', 'PageController@contactView')->name('contact');
    Route::post('/contact', 'PageController@contact')->name('contact.send');
    Route::get('/about', 'PageController@aboutView')->name('about');
    Route::post('/subscribe-to-our-news-letter', 'IndexController@newsLetter')->name('news_letter');

    //real estate
    Route::get('/real-estate', 'RealEstateController@index')->name('realestate');
    Route::get('/real-estate/type/{type}', 'RealEstateController@searchByType')->name('type.search');
    Route::get('/real-estate/category/{category}', 'RealEstateController@searchByCategory')->name('category.search');
    Route::get('/real-estate/state/{id}', 'RealEstateController@searchByState')->name('state.search');
    Route::get('/real-estate/price/{price}', 'RealEstateController@searchByPrice')->name('price.search');
    Route::get('/real-estate/details/{slug}', 'RealEstateController@getDetails')->name('real_estate.details');
    Route::get('/real-estate/search', 'RealEstateController@searchFilter')->name('real_estate.search');
    Route::post('/contact-owner', 'RealEstateController@contact')->name('owner.send');
    // subscribe to plan and checkout
    Route::get('/subscribe-to-plan/{plan}', 'ProcessController@subscribeView')->name('checkout.plan.show')->middleware('auth');
    Route::post('/subscribe-to-plan/{plan}', 'ProcessController@checkoutPlan')->name('checkout.plan')->middleware('auth');
    Route::post('/check-before-subscribe-to-plan', 'ProcessController@ConfirmToChangeThePlan')->name('checkout.confirm');

    // booking and buy the real estate
    Route::get('/checkout/{id}', 'ProcessController@checkoutView')->name('booking.checkout.view')->middleware('auth');
    Route::post('/checkout', 'ProcessController@checkoutProcess')->name('booking.checkout.process')->middleware('auth');

});

Auth::routes(['password.request'=>false,'reset'=>false]);
