<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = [
        'email1', 'email2', 'email3', 'contact_id'
    ];

    public function contact() {
        return $this->belongsTo('App\Contact');
    }
}
