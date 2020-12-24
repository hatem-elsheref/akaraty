<?php

namespace App\Http\Controllers\Front;


use App\Models\Country;
use App\Models\RealEstate;
use App\Models\State;
use App\Models\Plan;
use App\Models\User;
use App\Http\Controllers\Controller;


class HomeController extends Controller
{

    public function index()
    {
        $data['countries']      =Country::with('states')->get();
        $data['plans']          =Plan::orderByDesc('id')->get();
        $data['users']          =User::whereIn('role',[CUSTOMER,OWNER])->count();
        $data['admins']         =User::whereIn('role',[ADMIN])->count();
        $data['total_states']   =State::count();
        $data['randomPlaces']   =state::with('realEstates')->whereHas('realEstates')->inRandomOrder()->take(TOP)->get();
        $data['real_states']    =RealEstate::with('owner','state','state.country','images')->where('status','=','available')->orderByDesc('created_at')->take(PAGINATION)->get();
        $data['total_real_states']=RealEstate::count();
        return view('front.pages.home',$data);
    }



}
