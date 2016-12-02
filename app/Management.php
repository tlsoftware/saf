<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    protected $fillable = [
        'title', 'description', 'product', 'quantity', 'price', 'customer_id', 'created_at'
    ];

    public function customer() {
        return $this->belongsTo('App\Customer');
    }
}