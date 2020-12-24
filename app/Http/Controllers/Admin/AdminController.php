<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\RealEstate;
use App\Models\Order;
use App\OrderContacts;
use App\Models\Plan;
use App\Models\Subscribe;
use App\Models\User;

class AdminController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $this->user=auth()->user();
        if ($this->user->role === ADMIN){
            return view('admin.index',$this->adminIndexData());
        }elseif ($this->user->role === OWNER){
            return view('admin.owner.index',$this->ownerIndexData());
        }else{
            abort(403);
        }
    }
    private function adminIndexData(){
        $data['owners']                 =User::where('role',OWNER)->count();
        $data['customers']              =User::where('role',CUSTOMER)->count();
        $data['real_estates']           =RealEstate::count();
        $data['plans']                  =Plan::count();
        return $data;
    }
    public function ownerIndexData(){
        $data['price_of_daily_orders']=Order::whereDay('created_at',now())->where('owner_id',auth()->id())->select('total')->sum('total');
        $data['real_estates']         =RealEstate::where('user_id',auth()->id())->where('type','!=','land')->count();
        $data['daily_orders']         =Order::whereDay('created_at',now())->where('owner_id',auth()->id())->count();
        $data['real_estates_land']    =RealEstate::where('user_id',auth()->id())->where('type','land')->count();
        $data['price_of_total_items'] =Order::where('owner_id',auth()->id())->select('total')->sum('total');
        $data['messages']             =Contact::where('for',OWNER)->where('user_id',auth()->id())->count();
        $data['orders']               =Order::where('owner_id',auth()->id())->count();
        $data['pending_orders']       =Order::where('owner_id',auth()->id())->where('status',PENDING)->count();
        return $data;
    }
}
