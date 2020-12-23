<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class RealEstate extends Model
{
    protected $table='real_estates';
    protected $fillable=[
        'title','slug','user_id','area','price','category','floors_number','flats_number','buy_date',
        'long','lat','video','living_room_number','has_kitchen','has_parking','has_garage',
        'status','type','state_id','address','description','start_rent_date','end_rent_date',
        'has_pool','has_cleaning','has_internet','bed_room_number','bath_room_number'];

    public function owner(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    public function state(){
        return $this->belongsTo('App\Models\State','state_id','id');
    }
    public function mainImage(){
        return uploadedAssets($this->images->first()->src);
    }
    public function images(){
        return $this->hasMany('App\Models\Image','real_estate_id','id');
    }
    public function slug(){
        $this->slug= Str::slug(strtolower($this->title.' '.$this->id),'-');
        $this->save();
    }
}
