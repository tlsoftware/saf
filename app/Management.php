<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    public $updated_at = false;

    protected $fillable = [
        'description', 'quantity', 'price', 'customer_id', 'product_id'
    ];

    public function customer() {
        return $this->belongsTo('App\Customer');
    }

    public function product() {
        return $this->belongsTo('App\Product');
    }
}