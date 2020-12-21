<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsLetter extends Model
{
    protected $table='news_letters';
    protected $fillable=['email'];
}
