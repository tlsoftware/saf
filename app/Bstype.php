<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bstype extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'type', 'size', 'quantity'
    ];

    public function customers() {
        return $this->hasMany('App\Customer');

    }

    public static function getClassificationIdByName($classification_name) {
        $classification_name = $classification_name ?: 'Varios';

        return self::where('type', 'like', $classification_name)
            ->pluck('id')
            ->first() ?: 17;
    }
}
