<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    protected $fillable = [
        'description', 'product', 'quantity', 'price', 'customer_id'
    ];

    public function customer() {
        return $this->belongsTo('App\Customer');
    }
}