<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Management;

class Customer extends Model
{
    protected $fillable = [
        'rut', 'bs_name', 'name', 'web', 'status_detail_id', 'next_mng',
        'user_id', 'created_at', 'bstype_id', 'address', 'commune', 'city',
        'ctype'
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

    public function contact() {
        return $this->hasOne('App\Contact');
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

    public function lastManagement()
    {
         $management =  \App\Management::whereCustomerId($this->id)
             ->orderBy('created_at', 'desc')
             ->take(1)
             ->pluck('description')->toArray();

        $management_date =  \App\Management::whereCustomerId($this->id)
            ->orderBy('created_at', 'desc')
            ->take(1)
            ->pluck('created_at')->toArray();

            if ($management) {
                $last_management = $management[0];
                if (strtotime($management_date[0]) <= strtotime('2017-06-26 00:00')) {
                    $management_array = preg_split("/[\n.]+/", $management[0], -1, 1);
                    if (count($management_array) >= 1)
                        $last_management = $management_array[count($management_array) - 1];

                    if ($last_management == " " and count($management_array) >= 2)
                        $last_management = $management_array[count($management_array) - 2];
                }
                return $last_management;
            }
            return "Sin Gestion";
    }


}
