<?php

// for real estates
Route::get('/get-states-by-country','RealEstateController@getState')->name('country.state');
Route::group(['prefix'=>'real-estate'],function (){
    Route::get('/index','RealEstateController@index')->name('real-estate.index');
    Route::get('/show/{id}','RealEstateController@show')->name('real-estate.show');
    Route::get('/show-type/{type}','RealEstateController@getByType')->name('real-estate.get');
    Route::get('/create/building','RealEstateController@createBuilding')->name('real-estate.create_building');
    Route::get('/create/land','RealEstateController@createLand')->name('real-estate.create_land');
    Route::post('/store','RealEstateController@storeBuilding')->name('real-estate.store');
    Route::post('/storeLand','RealEstateController@storeLand')->name('real-estate.store_land');
    Route::get('/edit/{id}','RealEstateController@edit')->name('real-estate.edit');
    Route::put('/update/{id}','RealEstateController@updateBuilding')->name('real-estate.update_building');
    Route::put('/updateLand/{id}','RealEstateController@updateLand')->name('real-estate.update_land');
    Route::delete('/delete/{id}','RealEstateController@destroy')->name('real-estate.destroy');
    Route::post('/available/{id}','RealEstateController@available')->name('real-estate.available');
});


// for the Orders
Route::group(['prefix'=>'orders'],function (){
    Route::get('/archive','OrderController@allOperations')->name('orders.archive');
    Route::get('/new','OrderController@pending')->name('orders.pending');
    Route::post('/cancel/{id}','OrderController@cancel')->name('orders.cancel');
    Route::post('/approve/{id}','OrderController@approve')->name('orders.approve');
    Route::delete('/delete-the-order/{id}','OrderController@destroy')->name('orders.destroy');
});
// for clients supports or contacts
Route::group(['prefix'=>'clients-messages'],function (){
    // to view the clients messages and support
    Route::get('/all','OrderContactController@index')->name('order_contact.index');
    // to reply to the customer problem
    Route::post('/reply','OrderContactController@reply')->name('order_contact.reply');
    // to destroy the message
    Route::delete('/delete/{contact}','OrderContactController@destroy')->name('order_contact.destroy');
    // to update the status of the message  (read/unread)
    Route::get('/mark-as-read/{contact}','OrderContactController@update')->name('order_contact.update');
});
