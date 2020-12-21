<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table='states';
    public function country(){
        return $this->belongsTo('App\Models\Country','country_id','id');
    }
    public function realEstates(){
        return $this->hasMany('App\Models\RealEstate','state_id','id');
    }
}
