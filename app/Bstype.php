<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bstype extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'type', 'size', 'quantity'
    ];

    public function customers() {
        return $this->hasMany('App\Customer');

    }
}
