<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['id', 'state_id', 'title', 'slug'];

    public function state()
    {
        return $this->belongsTo('App\State');
    }

    public function neighborhoods()
    {
        return $this->hasMany('App\Neighborhood');
    }
}
