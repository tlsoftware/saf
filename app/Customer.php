<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'rut', 'bs_name', 'name', 'contact_name', 'position', 'phone1',
        'phone2', 'phone3', 'email1', 'email2', 'email3', 'web', 'status_detail_id',
        'next_mng', 'user_id', 'created_at', 'bstype_id'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function managements() {
        return $this->hasMany('App\Management');
    }

    public function bstype() {
        return $this->belongsTo('App\Bstype');
    }

    public function scopeSearch($query, $name)
    {
        return $query->where('name', 'LIKE', "%$name%");
    }

    public function status_detail()
    {
        return $this->belongsTo('App\Detail');
    }

    public function scopeNextMng($query, $dateFrom, $dateTo)
    {
        // dd('Scope: ' . $dateFrom . ' ' . $dateTo);
        if (trim($dateFrom) != "" && trim($dateTo != "")) {
            $query->whereBetween('next_mng', [$dateFrom, $dateTo]);
        }
    }

}
