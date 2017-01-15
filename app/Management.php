<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    public $updated_at = false;

    protected $fillable = [
        'description', 'quantity', 'price', 'customer_id', 'product_id', 'st_details', 'user_id', 'dispatch_date', 'dispatch_time'
    ];

    public function customer() {
        return $this->belongsTo('App\Customer');
    }

    public function product() {
        return $this->belongsTo('App\Product');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}