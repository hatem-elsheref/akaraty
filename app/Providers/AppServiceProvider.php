<?php

namespace App\Providers;

use App\Cart;
use App\Category;
use App\Models\Country;
use App\Models\State;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!request()->is('admin/*')){
            View::share('randomStates',State::inRandomOrder()->take(14)->get());
            View::share('countries',Country::with('states')->get());
        }


    }
}
