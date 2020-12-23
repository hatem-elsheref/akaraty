<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table='orders';

    protected $fillable=['first_name','last_name','country','months','method','gateway_transaction_checkout_id','address','postcode','phone','email','user_id','real_estate_id','status','total','owner_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    public function owner()
    {
        return $this->belongsTo('App\Models\User','owner_id','id');
    }
    public function realEstate()
    {
        return $this->belongsTo('App\Models\RealEstate','real_estate_id','id');
    }
}
