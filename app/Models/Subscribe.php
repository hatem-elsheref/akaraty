<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    protected $table='subscribes';
//    protected $fillable=['user_id','plan_id','transaction_id','status','request_is_expired'];
    protected $fillable=['user_id','plan_id','transaction_id','status'];

    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    public function plan(){
        return $this->belongsTo('App\Models\Plan','plan_id','id');
    }
    public function transaction(){
        return $this->belongsTo('App\Models\Transaction','transaction_id','id');
    }}
