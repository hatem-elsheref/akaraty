<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table='transactions';
    protected $fillable=['first_name','last_name','country','method','gateway_transaction_checkout_id','address','postcode','phone','email','user_id','plan_id'];
    protected function user()
    {
        $this->belongsTo('App\Models\User','user_id','id');
    }
    protected function plan()
    {
        $this->belongsTo('App\Models\Plan','plan_id','id');
    }
}
