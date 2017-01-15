<?php

namespace App\Http\Controllers;

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
        /*
         *
         * Estatus:
         *      SIN GESTION     => 0
         *      POTENCIALES     => 1
         *      MUESTRAS        => 2
         *      ACTIVOS         => 3
         *      RECHAZADOS      => 4
         *      BAJAS           => 5
         *
         */


        // PERFIL ADMINISTRADOR
        if (Auth::user()->admin) {
            $customers = Customer::Search($request->name)
                // CLIENTES SIN GESTION   (status => 0)
                ->where('next_mng', '<=', Carbon::now())
                ->where('status', '0')
                ->orderBy('next_mng', 'asc')
                ->orderBY('last_mng', 'asc')
                ->paginate(10);

            // No existen clientes SIN GESTION
            if ($customers->count() == 0) {
                // CLIENTES POTENCIALES (status => 1)
                $customers = Customer::Search($request->name)
                    ->where('next_mng', '<=', Carbon::now())
                    ->where('status', '1')
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->paginate(10);

                // No existen clientes POTENCIALES
            }
            if ($customers->count() == 0) {
                // CLIENTES MUESTRAS (status => 2)
                $customers = Customer::Search($request->name)
                    ->where('next_mng', '<=', Carbon::now())
                    ->where('status', '2')
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->paginate(10);

                // No existen clientes con MUESTRA
            }
            if ($customers->count() == 0) {
                // CLIENTES ACTIVOS (status => 3)
                $customers = Customer::Search($request->name)
                    ->where('next_mng', '<=', Carbon::now())
                    ->where('status', '3')
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->paginate(10);

                // No existen cientes PENDIENTES POR GESTION
            }
            if ($customers->count() == 0) {
                // CLIENTES POTENCIALES (status => 1)
                $customers = Customer::Search($request->name)
                    ->where('status', '1')
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->paginate(10);
            }
            if ($customers->count() == 0) {
                // CLIENTES MUESTRAS
                $customers = Customer::Search($request->name)
                    ->where('status', '2')
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->paginate(10);
            }
            if ($customers->count() == 0) {
                // CLIENTES ACTIVOS
                $customers = Customer::Search($request->name)
                    ->where('status', '3')
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
                ->where('status', '0')
                ->orderBy('next_mng', 'asc')
                ->orderBY('last_mng', 'asc')
                ->paginate(10);

            // No existen clientes SIN GESTION
            if ($customers->count() == 0) {
                // CLIENTES POTENCIALES
                $customers = Customer::Search($request->name)
                    ->where('next_mng', '<=', Carbon::now())
                    ->where('user_id', Auth::user()->id)
                    ->where('status', '1')
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
                    ->where('status', '2')
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
                    ->where('status', '3')
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->paginate(10);

                // No existen cientes PENDIENTES POR GESTION
            }
            if ($customers->count() == 0) {
                // CLIENTES POTENCIALES
                $customers = Customer::Search($request->name)
                    ->where('user_id', Auth::user()->id)
                    ->where('status', '1')
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->paginate(10);
            }
            if ($customers->count() == 0) {
                // CLIENTES MUESTRAS
                $customers = Customer::Search($request->name)
                    ->where('user_id', Auth::user()->id)
                    ->where('status', '2')
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->paginate(10);
            }
            if ($customers->count() == 0) {
                // CLIENTES ACTIVOS
                $customers = Customer::Search($request->name)
                    ->where('user_id', Auth::user()->id)
                    ->where('status', '3')
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->paginate(10);
            }
        }

        return view('home')
            ->with('customers', $customers);
    }
}
