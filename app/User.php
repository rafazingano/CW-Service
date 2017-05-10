<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'photo', 'service_provider', 'cpf_cnpj', 'content'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles() {
        return $this->belongsToMany(\App\Role::class);
    }

    public function hasPermission(Permission $permission) {
        return $this->hasAnyRoles($permission->roles);
    }

    public function hasAnyRoles($roles) {
        if (is_array($roles) || is_object($roles)) {
            return !!$roles->intersect($this->roles)->count();
        }
        return $this->roles->contains('slug', $roles);
    }

    public function locations() {
        return $this->hasMany('App\Location');
    }

    public function tags() {
        return $this->belongsToMany('App\Tag');
    }
    
    public function contacts() {
        return $this->belongsToMany('App\Contact');
    }

}
