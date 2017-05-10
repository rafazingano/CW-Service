<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model
{
    protected $fillable = ['id', 'city_id', 'title', 'slug'];

    public function city()
    {
        return $this->belongsTo('App\City');
    }
}
