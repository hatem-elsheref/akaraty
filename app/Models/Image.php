<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $table='images';
    protected $fillable=['src','real_estate_id'];

    public function realEstate(){
        return $this->belongsTo('App\Models\RealEstate','real_estate_id','id');
    }

    public function src(){
        return uploadedAssets($this->src);
    }
}
