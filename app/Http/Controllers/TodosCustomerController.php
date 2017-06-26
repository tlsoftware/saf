<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Customer;
use App\Management;
use Laracasts\Flash\Flash;
use Carbon\Carbon;

class TodosCustomerController extends Controller
{
    public function show()
    {
        if (Auth::user()->admin)
        {
            $customers = Customer::orderBy('next_mng', 'asc')
                ->orderBY('last_mng', 'asc')
                ->get();

        }

        // Si es Vendedor carga solo los clientes pendientes de ese Vendedor
        else {
            $customers = Customer::where('user_id', Auth::user()->id)
                // ->where('status', '4')
                ->orderBy('next_mng', 'asc')
                ->orderBY('last_mng', 'asc')
                ->get();

        }
        /*
         *  Si el Vendedor no tiene Clientes Pendientes por Gestionar
         *  Cargamos todos los clientes del Vendedor
         */
        if($customers->count() == 0) {
            Flash::error('No Posee Clientes Asociados!!');
        }

        return view('todos.show')
            ->with('customers', $customers);

    }
}
