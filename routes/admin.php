<?php

// for the  product
Route::group(['prefix'=>'real-estates'],function (){
    // to view the available plans
    Route::get('/all','RealEstateController@getAllRealEstatesToAdmin')->name('real-estate.all');
    Route::get('/{id}/details','RealEstateController@show')->name('real_estate.show');
});
// for the  plans
Route::group(['prefix'=>'plan'],function (){
    // to view the available plans
    Route::get('/all','PlanController@index')->name('plans.index');
    // to add new plan
    Route::get('/create','PlanController@create')->name('plans.create');
    // to store the new plan
    Route::post('/create','PlanController@store')->name('plans.store');
    // to edit plan
    Route::get('/edit/{plan}','PlanController@edit')->name('plans.edit');
    // to update the plan
    Route::put('/update/{plan}','PlanController@update')->name('plans.update');
    // to destroy the plan
    Route::delete('/delete/{plan}','PlanController@destroy')->name('plans.destroy');
});
// for the  plan-orders
Route::group(['prefix'=>'plan-orders'],function (){
    // to view the available request plans
    Route::get('/all','PlansOrderController@getAllSubscription')->name('planOrders.index');
    // to approve the order
    Route::post('/approve/{id}','PlansOrderController@approveThePlan')->name('planOrders.approve');
    // to cancel the order
    Route::delete('/delete/{id}','PlansOrderController@destroy')->name('planOrders.destroy');
});
// for the  owners
Route::group(['prefix'=>'owners'],function (){
    // to view the owners
    Route::get('/all','OwnerController@index')->name('owner.index');
    // to view the owners real estates
    Route::get('/realEstates/{owner}','OwnerController@realEstates')->name('owner.real_estates');
    // to update the owner (block or not)
    Route::put('/update/{owner}/blocking','OwnerController@updateStatus')->name('owner.update.status');
});
// for the  customer
Route::group(['prefix'=>'customer'],function (){
    // to view the customer
    Route::get('/all','CustomerController@index')->name('customer.index');
    // to update the customer
    Route::put('/update/{customer}','CustomerController@update')->name('customer.update');
});

Route::group(['prefix'=>'contacts'],function (){
    // to view the clients messages and support
    Route::get('/all','ContactController@index')->name('contact.index');
    // to reply to the customer problem
    Route::post('/reply','ContactController@reply')->name('contact.reply');
    // to destroy the message
    Route::delete('/delete/{contact}','ContactController@destroy')->name('contact.destroy');
    // to update the status of the message  (read/unread)
    Route::get('/mark-as-read/{contact}','ContactController@update')->name('contact.update');
});

