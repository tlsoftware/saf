<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'admin'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function customers() {
        return $this->hasMany('App\Customer');
    }

    public function scopeSearch($query, $name)
    {
        return $query->where('name', 'LIKE', "%$name%");
    }

    // Mutators

    public function setNameAttribute($value){
        $this->attributes['name'] = ucfirst($value);
    }

    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }
}