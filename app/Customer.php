<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'rut', 'bs_name', 'name', 'contact_name', 'position', 'phone1',
        'phone2', 'phone3', 'email1', 'email2', 'email3', 'web', 'status',
        'next_mng', 'user_id', 'created_at'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function managements() {
        return $this->hasMany('App\Management');
    }

    public function ScopeSearch($query, $bs_name)
    {
        return $query->where('bs_name', 'LIKE', "%$bs_name%");
    }
}
