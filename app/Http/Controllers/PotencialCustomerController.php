<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Management;
use Auth;
use Laracasts\Flash\Flash;

class PotencialCustomerController extends Controller
{
    public function index($id)
    {
        $customer = Customer::find($id);

        $managements = Management::where('customer_id', $id)
            ->orderBY('created_at', 'DESC')
            ->limit('3')
            ->get();

        return view('potencials.index')
            ->with('customer', $customer)
            ->with(compact('managements', $managements));
    }

    public function show(Request $request)
    {
        if (Auth::user()->admin)
        {
            $customers = Customer::Search($request->bs_name)
                ->where('status', '==', '1')
                ->orderBy('next_mng', 'asc')
                ->orderBY('last_mng', 'asc')
                ->paginate(10);

        }

        // Si es Vendedor carga solo los clientes pendientes de ese Vendedor
        else {
            $customers = Customer::Search($request->bs_name)
                ->where('user_id', Auth::user()->id)
                ->where('status', '<', '2')
                ->orderBy('next_mng', 'asc')
                ->orderBY('last_mng', 'asc')
                ->paginate(10);

        }
            /*
             *  Si el Vendedor no tiene Clientes Pendientes por Gestionar
             *  Cargamos todos los clientes del Vendedor
             */
        if($customers->count() == 0) {
            Flash::warning('No Posee Potenciales Clientes Asociados!!');
        }

        return view('potencials.show')
            ->with('customers', $customers);

    }
}





/*

   // Redireccionamos a la Pagina de Clientes Potenciales
       $customers = Customer::Search($request->bs_name)
           ->where('user_id', Auth::user()->id)
           ->where('status', '==', '2')
           ->orderBy('next_mng', 'asc')
           ->orderBY('last_mng', 'asc')
           ->paginate(10);

       Flash::warning('No Posee Potenciales Clientes Asociados!!');

   }
   elseif ($customers->count() == 0) {
       $customers = Customer::Search($request->bs_name)
           ->where('user_id', Auth::user()->id)
           ->where('status', '==', '3')
           ->orderBy('next_mng', 'asc')
           ->orderBY('last_mng', 'asc')
           ->paginate(10);

       Flash::warning('No Posee Potenciales Clientes con Muestras Entregadas!!');

   } elseif ($customers->count() == 0) {
       $customers = Customer::Search($request->bs_name)
           ->where('user_id', Auth::user()->id)
           ->where('status', '==', '4')
           ->orderBy('next_mng', 'asc')
           ->orderBY('last_mng', 'asc')
           ->paginate(10);

       Flash::warning('No Posee Clientes Activos Asociados!!');
   }
}

