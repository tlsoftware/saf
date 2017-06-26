<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'code', 'name',
    ];

    public function sale() {
        return $this->belongsTo('App\Sale');

    }
}
