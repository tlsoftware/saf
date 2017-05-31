<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'statuses';

    protected $fillable = ['name'];

    public function details() {
        return $this->hasMany('App\Detail');

    }
}
