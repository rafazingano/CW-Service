<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagBlacklist extends Model
{
    public function tag()
    {
        return $this->belongsTo('App\Tag');
    }
}
