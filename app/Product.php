<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'code', 'name',
    ];

    public function managements() {
        return $this->hasMany('App\Management');

    }
}
