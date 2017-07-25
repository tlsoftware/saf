<?php

namespace App\Http\Controllers;

use App\Detail;
use Auth;
use App\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status_ids = Detail::getStatusDetailIdHome()->toArray();


        $q_customers_id = DB::table('customers')
            ->join('statuses_details', 'customers.status_detail_id', '=', 'statuses_details.id')
            ->where('customers.next_mng', '<=', Carbon::now())
            ->whereIn('customers.status_detail_id', $status_ids)
            ->select('customers.id');

        // PERFIL USUARIO
        if (! Auth::user()->isAdmin()) {
            $q_customers_id->where('customers.user_id', '=', Auth::user()->id);
        }

        $customers_id = $q_customers_id->orderBy('statuses_details.priority' ,'ASC')
            ->orderBy('customers.next_mng', 'ASC')
            ->orderBy('customers.last_mng', 'DESC')
            ->pluck('id');

        $customers = collect();
        foreach ($customers_id as $id) {
            $customers->push(Customer::find($id));
        }

        return view('home')->with('customers', $customers);

    }

    public static function convert_date_es_to_en($date)
    {
        if (strlen($date) < 10) return "";
        $date = self::left($date, 10);
        $date = str_replace("-", "/", $date);
        if ($date == '00/00/0000') return "";
        $parts = explode("/", $date);
        return $parts[2] . '-' . $parts[1] . '-' . $parts[0];
    }

    public static function left($string, $count){
        return substr($string, 0, $count);
    }

}
