<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderContacts;
use App\Plan;
use App\Product;
use App\Subscribe;
use App\User;
use Cassandra\Custom;
use Illuminate\Http\Request;

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
        $data=[];
        $data['sellers']                =0;#=User::where('role',SELLER)->count();
        $data['category']               =0;#=Category::get()->count();
        $data['products']               =0;#=Product::count();
        $data['plans']                  =0;#=Plan::count();
        $data['plan_orders']            =0;#=Subscribe::count();
        $data['customers']              =0;#=User::where('role',CUSTOMER)->count();
        $data['daily_orders']           =0;#=Order::whereDay('created_at',now())->count();
        $data['price_of_daily_orders']  =0;#=Order::whereDay('created_at',now())->where('status',DELIVERED)->sum('total');
        $data['price_of_total_products']=0;#=Order::whereMonth('created_at',now())->sum('total');
        $data['shipped_orders']         =0;#=Order::where('status',SHIPPED)->count();
        $data['pending_orders']         =0;#=Order::where('status',PENDING)->count();
        $data['delivered_orders']       =0;#=Order::where('status',DELIVERED)->count();
        return $data;
    }
    public function ownerIndexData(){
//        $data['category']   =Category::get()->count();
//        $data['products']   =Product::where('user_id',$user->id)->count();
//        $data['daily_orders']=Order::whereDay('created_at',now())->where('seller_id',$user->id)->where('seller_id',$user->id)->count();
//        $data['price_of_total_products']=Order::whereMonth('created_at',now())->where('seller_id',$user->id)->select('total')->sum('total');
//        $data['price_of_daily_orders']=Order::whereDay('created_at',now())->where('seller_id',$user->id)->where('status',DELIVERED)->sum('total');
//        $data['shipped_orders']=Order::where('status',SHIPPED)->where('seller_id',$user->id)->count();
//        $data['pending_orders']=Order::where('status',PENDING)->where('seller_id',$user->id)->count();
//        $data['delivered_orders']=Order::where('status',DELIVERED)->where('seller_id',$user->id)->count();
        $data['category']    =0;
        $data['daily_orders']=0;
        $data['products']    =0;
        $data['price_of_total_products']=0;
        $data['price_of_daily_orders']  =0;
        $data['shipped_orders']=0;
        $data['pending_orders']=0;
        $data['delivered_orders']=0;
        return $data;
    }
}
