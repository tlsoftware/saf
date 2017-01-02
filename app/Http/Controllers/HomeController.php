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

        // Si es Administrador Cargar todos los Clientes pendientes
       if (Auth::user()->admin)
       {
           $customers = Customer::Search($request->name)
               ->where('next_mng', '<=', Carbon::now())
               ->where('status', '0')
               ->orderBy('next_mng', 'asc')
               ->orderBY('last_mng', 'asc')
               ->paginate(10);

           // Si no existen clientes sin Gestión
            if($customers->count() == 0) {
                $customers = Customer::Search($request->name)
                    ->where('next_mng', '<=', Carbon::now())
                    ->where('status', '1')
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->paginate(10);

            // Si no existen clientes potenciales vencidos
            } else if ($customers->count() == 0) {
                $customers = Customer::Search($request->name)
                    ->where('next_mng', '<=', Carbon::now())
                    ->where('status', '2')
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->paginate(10);

           // Si no existen clientes con muestra entregada
            } else if ($customers->count() == 0) {
                $customers = Customer::Search($request->name)
                    ->where('next_mng', '<=', Carbon::now())
                    ->where('status', '3')
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->paginate(10);
            }

       }

       // Si es Vendedor carga solo los clientes pendientes de ese Vendedor
       else {
           $customers = Customer::Search($request->name)
               ->where('user_id', Auth::user()->id)
               ->where('status','<', '2')
               ->where('next_mng', '<=', Carbon::now())
               ->orderBy('next_mng', 'asc')
               ->orderBY('last_mng', 'asc')
               ->paginate(10);
       }

        if($customers->count() == 0)
            Flash::warning('No Tiene Clientes Pendientes por Gestionar!!');

        return view('home')
            ->with('customers', $customers);

    }

}


/*
 *  Si el Vendedor no tiene Clientes Pendientes por Gestionar
 *  Cargamos todos los clientes del Vendedor
 */
/*
            if($customers->count() == 0) {
                $customers = Customer::Search($request->bs_name)
                    ->where('user_id', Auth::user()->id)
                    ->where('status', '=', '1')
                    ->orderBy('next_mng', 'asc')
                    ->orderBY('last_mng', 'asc')
                    ->paginate(10);

                Flash::warning('No Tiene Clientes Pendientes por Gestionar!!');


                return view('home')
                    ->with('customers', $customers);

                if (!$customers->count() == 0) {
                    // return view('home')
                    //    ->with('customers', $customers);
                } else {
                    return view('welcome');
                }
            }
            //
        }
        return view('home')
           ->with('customers', $customers);
