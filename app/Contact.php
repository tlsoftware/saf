<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name', 'position', 'type', 'customer_id'
    ];

    public function customer() {
        return $this->belongsTo('App\Customer');
    }

    public function phone() {
        return $this->hasOne('App\Phone');
    }

    public function email() {
        return $this->belongsTo('App\Email');
    }
}
