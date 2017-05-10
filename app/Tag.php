<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'title', 'slug', 'status'
    ];     
    
    public function tagignored()
    {
        return $this->hasMany('App\TagIgnored');
    }
    
    public function tagbalcklist()
    {
        return $this->hasMany('App\TagBlacklist');
    }
    
    public function users() {
        return $this->belongsToMany('App\User');
    }
    
    
}
