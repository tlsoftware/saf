<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    public $updated_at = false;

    protected $fillable = [
        'description', 'customer_id', 'user_id', 'dispatch_date', 'dispatch_time'
    ];

    public function customer() {
        return $this->belongsTo('App\Customer');
    }

    public function product() {
        return $this->belongsTo('App\Product');
    }

    public function user() {
        return $this->belongsTo('App\User')->withTrashed();
    }

    public function sales() {
        return $this->hasMany('App\Sale');
    }

    public function getStatus() {
        $status_detail = Detail::find($this->status_detail_id);
        $status = Status::find($status_detail->status_id);

        return "($status->name) ". $status_detail->name;
    }
}