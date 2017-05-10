<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = ['id', 'abbr', 'title', 'slug'];

    public function cities()
    {
        return $this->hasMany('App\City');
    }
}
