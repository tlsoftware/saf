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
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $potencial_ids = Detail::where('status_id', 1)->pluck('id')->toArray();
        $muestra_ids   = Detail::where('status_id', 2)->pluck('id')->toArray();
        $rechazo_ids   = Detail::where('status_id', 3)->pluck('id')->toArray();
        $activo_ids    = Detail::where('status_id', 4)->pluck('id')->toArray();
        $baja_ids      = Detail::where('status_id', 5)->pluck('id')->toArray();

        // PERFIL ADMINISTRADOR
        if (Auth::user()->admin) {
            $customers = Customer::Search($request->name)
                // CLIENTES SIN GESTION   (status => 0)
                ->where('next_mng', '<=', Carbon::now())
                ->where('status_detail_id', 1)
                ->orderBy('next_mng', 'asc')
                ->orderBY('last_mng', 'asc')
                ->paginate(10);

            // No existen clientes SIN GESTION
            if ($customers->count() == 0) {
                // CLIENTES POTENCIALES (status => 1)
                $customers = Customer::Search($request->name)
                    ->where('next_mng', '<=', Carbon::now())
                    ->whereIn('status_detail_id', $potencial_ids)
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->paginate(10);

                // No existen clientes POTENCIALES
            }
            if ($customers->count() == 0) {
                // CLIENTES MUESTRAS (status => 2)
                $customers = Customer::Search($request->name)
                    ->where('next_mng', '<=', Carbon::now())
                    ->whereIn('status_detail_id', $muestra_ids)
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->paginate(10);

                // No existen clientes con MUESTRA
            }
            if ($customers->count() == 0) {
                // CLIENTES ACTIVOS (status => 3)
                $customers = Customer::Search($request->name)
                    ->where('next_mng', '<=', Carbon::now())
                    ->whereIn('status_detail_id', $activo_ids)
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->paginate(10);

                // No existen cientes PENDIENTES POR GESTION
            }
            if ($customers->count() == 0) {
                // CLIENTES POTENCIALES (status => 1)
                $customers = Customer::Search($request->name)
                    ->whereIn('status_detail_id', $potencial_ids)
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->paginate(10);
            }
            if ($customers->count() == 0) {
                // CLIENTES MUESTRAS
                $customers = Customer::Search($request->name)
                    ->whereIn('status_detail_id', $muestra_ids)
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->paginate(10);
            }
            if ($customers->count() == 0) {
                // CLIENTES ACTIVOS
                $customers = Customer::Search($request->name)
                    ->whereIn('status_detail_id', $activo_ids)
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->paginate(10);
            }
        }

        /*
         * ****************************************
         *          PERFIL VENDEDOR
         * ****************************************
         */
        else {
            $customers = Customer::Search($request->name)
                // CLIENTES SIN GESTION
                ->where('user_id', Auth::user()->id)
                ->where('next_mng', '<=', Carbon::now())
                ->whereIn('status_detail_id', 1)
                ->orderBy('next_mng', 'asc')
                ->orderBY('last_mng', 'asc')
                ->paginate(10);

            // No existen clientes SIN GESTION
            if ($customers->count() == 0) {
                // CLIENTES POTENCIALES
                $customers = Customer::Search($request->name)
                    ->where('next_mng', '<=', Carbon::now())
                    ->where('user_id', Auth::user()->id)
                    ->whereIn('status_detail_id', $potencial_ids)
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->paginate(10);

                // No existen clientes POTENCIALES
            }
            if ($customers->count() == 0) {
                // CLIENTES MUESTRAS
                $customers = Customer::Search($request->name)
                    ->where('user_id', Auth::user()->id)
                    ->where('next_mng', '<=', Carbon::now())
                    ->whereIn('status_detail_id', $muestra_ids)
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->paginate(10);

                // No existen clientes con MUESTRA
            }
            if ($customers->count() == 0) {
                // CLIENTES ACTIVOS
                $customers = Customer::Search($request->name)
                    ->where('user_id', Auth::user()->id)
                    ->where('next_mng', '<=', Carbon::now())
                    ->whereIn('status_detail_id', $activo_ids)
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->paginate(10);

                // No existen cientes PENDIENTES POR GESTION
            }
            if ($customers->count() == 0) {
                // CLIENTES POTENCIALES
                $customers = Customer::Search($request->name)
                    ->where('user_id', Auth::user()->id)
                    ->whereIn('status_detail_id', $potencial_ids)
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->paginate(10);
            }
            if ($customers->count() == 0) {
                // CLIENTES MUESTRAS
                $customers = Customer::Search($request->name)
                    ->where('user_id', Auth::user()->id)
                    ->whereIn('status_detail_id', $muestra_ids)
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->paginate(10);
            }
            if ($customers->count() == 0) {
                // CLIENTES ACTIVOS
                $customers = Customer::Search($request->name)
                    ->where('user_id', Auth::user()->id)
                    ->whereIn('status_detail_id', $activo_ids)
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->paginate(10);
            }
        }

        return view('home')
            ->with('customers', $customers);
    }
}
