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

    public static function getPotentials()
    {
        return self::where('status_id', 1)
            ->pluck('id')
            ->toArray();
    }

    public static function getSamples()
    {
        return self::where('status_id', 2)
            ->pluck('id')
            ->toArray();
    }

    public static function getRejected()
    {
        return self::where('status_id', 3)
            ->pluck('id')
            ->toArray();
    }

    public static function getActives()
    {
        return self::where('status_id', 4)
            ->pluck('id')
            ->toArray();
    }

    public static function getLowCustomer()
    {
        return  self::where('status_id', 5)
            ->pluck('id')
            ->toArray();
    }

    public static function getPurchasePromise()
    {
        return self::where('name', 'like', 'Promesa de Compra')->pluck('id')->first();

    }

    public static function getTrackingSamples()
    {
        return self::where('name', 'like', 'En Seguimiento')
            ->whereStatusId(2)
            ->pluck('id')
            ->first();

    }


}
