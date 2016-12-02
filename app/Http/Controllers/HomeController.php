<?php

namespace App\Http\Controllers;

use Auth;
use App\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

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
           $customers = Customer::Search($request->bs_name)
               ->where('next_mng', '<=', Carbon::now())
               ->orderBy('next_mng', 'asc')
               ->paginate(5);
           // return view('home')
           //    ->with('customers', $customers);
       }
       // Si es Vendedor carga solo los clientes pendientes de ese Vendedor
       else {
           $customers = Customer::Search($request->bs_name)
               ->where('user_id', Auth::user()->id)
               ->where('next_mng', '<=', Carbon::now())
               ->orderBy('next_mng', 'asc')
               ->paginate(5);

           /*
            *  Si el Vendedor no tiene Clientes Pendientes por Gestionar
            *  Cargamos todos los clientes del Vendedor
            */
            if($customers->count() == 0) {
                $customers = Customer::Search($request->bs_name)
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('next_mng', 'asc')
                    ->paginate(5);
                /*
                 *  Si el vendedor no tiene Clientes Asociados
                 *  Redirigimos a la Pagina para Cargar un Nuevo Cliente
                 */
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
    }

}
