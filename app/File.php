<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'demand_id', 'user_id', 'file'
    ]; 
}
