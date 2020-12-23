<?php
// some general constants
use App\ProductRate;

define('PAGINATION',12);
define('TOP',6);
define('DEFAULT_REAL_ESTATE','default-building.png');
define('COD','COD');
define('GATEWAY','GATEWAY');
define('PENDING','pending');
define('APPROVED','approved');
define('RENT','rent');
define('BUY','buy');
define('ANNUAL','bi-annually');
define('MONTH','month');



// the three (3) main roles in system
define('ADMIN','admin');
define('OWNER','owner');
define('CUSTOMER','customer');

// the prefix of admin panel
define('ADMIN_PREFIX','admin');

// function return the default currency of real state
if (!function_exists('currency')){
    function currency(){
        return '$';
    }
}

// function to active the current url
if (!function_exists('inTheCurrentRoute')){
    function inTheCurrentRoute($route,$other=null){
        if (request()->is('admin/'.$route) or request()->is('admin/'.$other) ){
            return  'active';
        }else{
            return (\Illuminate\Support\Facades\Route::getCurrentRoute()->getName() === $route)? 'active':'';
        }

    }
}

// function to toast success
if (!function_exists('success')){
    function success($message='Success Operation'){
        toast($message,'success');
    }
}
// function to toast fail
if (!function_exists('fail')){
    function fail($message='Failed Operation'){
        toast($message,'error');
    }
}

// function return numbers of beds and bathrooms
if (!function_exists('beds_bathrooms')){
    function beds_bathrooms(){
        return ['1'=>'1','2'=>'2','3'=>'3','4'=>'4','+5'=>'5 or 5+'];
    }
}

// function return the category of real state
if (!function_exists('category')){
    function category(){
        return ['rent','buy'];
    }
}


if (!function_exists('randomCityImage')){
    function randomCityImage(){
       $images=['1.jpg','2.jpg','3.jpg','4.jpg','5.jpg'];
        return  $images[rand(0,count($images)-1)];
    }
}
// function return the types of real state
if (!function_exists('realState')){
    function realState(){
        return buildingTypes();
//        return ['Single Building'=>'single-building','Multi Building'=>'multi-building','Land'=>'land'];
    }
}
// building types
if (!function_exists('buildingTypes')){
    function buildingTypes(){
        return [
//            'shop'     =>'Shop',
//            'office'   =>'Office',
//            'warehouse'=>'Warehouse',
            'apartment'=>'Apartment',
            'building' =>'Building',
            'land'     =>'Land',
        ];
    }
}


