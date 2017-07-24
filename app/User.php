<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'username'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $roles = [
      'admin'       => 'Administrador',
      'supervisor'  => 'Supervisor',
      'user'        => 'Vendedor'
    ];

    protected $dates = ['deleted_at'];

    public function customers() {
        return $this->hasMany('App\Customer');
    }

    public function managemets() {
        return $this->hasMany('App\Management');
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

    public function isAdmin()
    {
        return $this->role == 'admin' ? true : false;
    }

    public function isSupervisor()
    {
        return $this->role == 'supervisor' ? true : false;
    }

    public function getRole()
    {
        return $this->roles[$this->role];

    }

}