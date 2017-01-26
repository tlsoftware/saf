<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Status;

class Detail extends Model
{
    protected $table = 'details';

    protected $fillable = ['name', 'status_id'];

    public  static function details($id) {
        return Detail::where('status_id', '$id')
            ->get();
    }

    public function status() {
        return $this->belongsTo('App\Status');
    }
}
