<?php

namespace App\Http\Controllers;

use App\Detail;
use Auth;
use App\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
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
    public function index(Request $request)
    {
        $dateFrom = self::convert_date_es_to_en($request->dateFrom);
        $dateTo = self::convert_date_es_to_en($request->dateTo);



        // PERFIL ADMINISTRADOR
        if (Auth::user()->isAdmin()) {
            // CLIENTES SIN GESTION   (status => 0)
            $customers = Customer::where('next_mng', '<=', Carbon::now())
                ->where('status_detail_id', 1)
                ->orderBy('next_mng', 'asc')
                ->orderBY('last_mng', 'asc')
                ->get();

            $status = 'Clientes sin Gestion';

            // No existen clientes SIN GESTION
            if ($customers->count() == 0) {
                // CLIENTES POTENCIALES (status => 1)
                $customers = Customer::where('next_mng', '<=', Carbon::now())
                    ->whereIn('status_detail_id', Detail::getPotentials())
                    ->nextMng($dateFrom, $dateTo)
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->get();

                $status = 'Potenciales Clientes';
                // No existen clientes POTENCIALES
            }
            if ($customers->count() == 0) {
                // CLIENTES MUESTRAS (status => 2)
                $customers = Customer::nextMng($dateFrom, $dateTo)
                    ->where('next_mng', '<=', Carbon::now())
                    ->whereIn('status_detail_id', Detail::getSamples())
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->get();
                $status = 'Muestras';

                // No existen clientes con MUESTRA
            }
            if ($customers->count() == 0) {
                // CLIENTES ACTIVOS (status => 3)
                $customers = Customer::where('next_mng', '<=', Carbon::now())
                    ->whereIn('status_detail_id', Detail::getActives())
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->get();
                $status = 'Clientes Activos';

                // No existen cientes PENDIENTES POR GESTION
            }
            if ($customers->count() == 0) {
                // CLIENTES POTENCIALES (status => 1)
                $customers = Customer::whereIn('status_detail_id', Detail::getPotentials())
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->get();
                $status = 'Potenciales Clientes';

            }
            if ($customers->count() == 0) {
                // CLIENTES MUESTRAS
                $customers = Customer::whereIn('status_detail_id', Detail::getSamples())
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->get();
                $status = 'Muestras';
            }
            if ($customers->count() == 0) {
                // CLIENTES ACTIVOS
                $customers = Customer::whereIn('status_detail_id', Detail::getActives())
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->get();
                $status = 'Clientes Activos';
            }
        }

        /*
         * ****************************************
         *          PERFIL VENDEDOR
         * ****************************************
         */
        else {
            // CLIENTES SIN GESTION
            $customers = Customer::where('user_id', Auth::user()->id)
                ->where('next_mng', '<=', Carbon::now())
                ->where('status_detail_id', 1)
                ->orderBy('next_mng', 'asc')
                ->orderBY('last_mng', 'asc')
                ->get();
            $status = 'Clientes sin Gestion';

            // No existen clientes SIN GESTION
            if ($customers->count() == 0) {
                // CLIENTES POTENCIALES
                $customers = Customer::where('next_mng', '<=', Carbon::now())
                    ->where('user_id', Auth::user()->id)
                    ->whereIn('status_detail_id', Detail::getPotentials())
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->get();
                $status = 'Potenciales Clientes';


                // No existen clientes POTENCIALES
            }
            if ($customers->count() == 0) {
                // CLIENTES MUESTRAS
                $customers = Customer::where('user_id', Auth::user()->id)
                    ->where('next_mng', '<=', Carbon::now())
                    ->whereIn('status_detail_id', Detail::getSamples())
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->get();
                $status = 'Muestras';


                // No existen clientes con MUESTRA
            }
            if ($customers->count() == 0) {
                // CLIENTES ACTIVOS
                $customers = Customer::where('user_id', Auth::user()->id)
                    ->where('next_mng', '<=', Carbon::now())
                    ->whereIn('status_detail_id', Detail::getActives())
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->get();
                $status = 'Clientes Activos';

                // No existen cientes PENDIENTES POR GESTION
            }
            if ($customers->count() == 0) {
                // CLIENTES POTENCIALES
                $customers = Customer::where('user_id', Auth::user()->id)
                    ->whereIn('status_detail_id', Detail::getPotentials())
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->get();
                $status = 'Potenciales Clientes';
            }
            if ($customers->count() == 0) {
                // CLIENTES MUESTRAS
                $customers = Customer::where('user_id', Auth::user()->id)
                    ->whereIn('status_detail_id', Detail::getSamples())
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->get();
                $status = 'Muestras';
            }
            if ($customers->count() == 0) {
                // CLIENTES ACTIVOS
                $customers = Customer::where('user_id', Auth::user()->id)
                    ->whereIn('status_detail_id', Detail::getActives())
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->get();
                $status = 'Clientes Activos';
            }
        }

        return view('home')->with('customers', $customers)->with('status', $status);
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
