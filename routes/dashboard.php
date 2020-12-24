<?php
use \Illuminate\Support\Facades\Route;
// this routes related to the admin and seller
Route::group(['prefix'=>ADMIN_PREFIX,'middleware'=>['auth:web','plan']],function(){
    // for both admin and seller
    Route::group(['middleware'=>'dashboard:'.ADMIN.','.OWNER],function (){
        // for the index of dashboard for both admin and seller
        Route::get('/','AdminController@index')->name('dashboard');
    });
    // for admin only
    Route::group(['middleware'=>['dashboard:'.ADMIN]],function (){
        require_once 'admin.php';
    });
    // for seller only
    Route::group(['middleware'=>['dashboard:'.OWNER]],function (){
        require_once 'owner.php';
    });


});
