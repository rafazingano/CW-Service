<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagIgnored extends Model
{
    public function tag()
    {
        return $this->belongsTo('App\Tag');
    }
}
