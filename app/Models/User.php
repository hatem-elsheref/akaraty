<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password','image','role','phone','status','plan_id','plan_starting_date','tmp_key'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['email_verified_at' => 'datetime'];


    public function plan(){
        return $this->belongsTo('App\Models\Plan','plan_id','id');
    }
    public function realEstates(){
        return $this->hasMany('App\Models\RealEstate','user_id','id');
    }



//    public function products(){
//        return $this->hasMany('App\Product','user_id','id');
//    }
//    public function transactions(){
//        return $this->hasMany('App\Transaction','user_id','id');
//    }
//    public function orders(){
//        return $this->hasMany('App\Order','user_id','id');
//    }
}
