<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $table = 'statuses_details';
    protected $fillable = ['id', 'name', 'status_id'];

    public function status() {
        return $this->belongsTo('App\Status');
    }

    public function customers()
    {
        return $this->hasMany('App\Customer');
    }

}
