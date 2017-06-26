<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable = [
        'phone1', 'phone2', 'phone3', 'contact_id'
    ];

    public function contact() {
        return $this->belongsTo('App\Contact');
    }

}
