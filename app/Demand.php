<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    protected $fillable = [
        'content', 'deadline', 'user_id', 'location_id'
    ];
    
    public function location()
    {
        return $this->belongsTo('App\Location');
    }
    
    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }
    
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
     
    public function files()
    {
        return $this->hasMany('App\File');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}
