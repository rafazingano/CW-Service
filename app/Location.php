<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model {

    protected $fillable = [
        'state_id',
        'city_id',
        'neighborhood_id',
        'user_id',
        'title',
        'address',
        'number',
        'complement',
        'postcode',
        'latitude',
        'longitude'
    ];

    public function state() {
        return $this->belongsTo('App\State');
    }

    public function city() {
        return $this->belongsTo('App\City');
    }

    public function neighborhood() {
        return $this->belongsTo('App\Neighborhood');
    }

}
