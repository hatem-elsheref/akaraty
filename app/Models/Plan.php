<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable=['title','name','price','period'];
    protected $table='plans';
    public function users(){
        return $this->hasMany('App\Models\User','plan_id','id');
    }

}
