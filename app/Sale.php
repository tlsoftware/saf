<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public $updated_at = false;

    protected $fillable = [
        'quantity', 'price', 'product_id'
    ];

    public function management() {
        return $this->belongsTo('App\Management');
    }

    public function products() {
        return $this->hasMany('App\Product');
    }
}