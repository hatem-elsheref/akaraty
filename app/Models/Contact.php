<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table='contacts';
    protected $fillable=['name','email','phone','message','status','user_id','for','realEstate'];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function real_estate()
    {
        return $this->belongsTo('App\Models\RealEstate','realEstate','id');
    }
}
