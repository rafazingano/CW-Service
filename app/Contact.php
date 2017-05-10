<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'user_id', 'demand_id', 'reply_id', 'approved', 'content'
    ];
    
    public function user() {
        return $this->belongsTo('App\User');
    }
    
    public function demand() {
        return $this->belongsTo('App\Demand');
    }
}
