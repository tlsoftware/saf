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
    public function show(Request $request)
    {
        if (Auth::user()->admin)
        {
            $customers = Customer::Search($request->name)
                // ->where('status', '4')
                // ->where('next_mng', '>', Carbon::now())
                ->orderBy('next_mng', 'asc')
                ->orderBY('last_mng', 'asc')
                ->paginate(10);

        }

        // Si es Vendedor carga solo los clientes pendientes de ese Vendedor
        else {
            $customers = Customer::Search($request->name)
                ->where('user_id', Auth::user()->id)
                // ->where('status', '4')
                ->orderBy('next_mng', 'asc')
                ->orderBY('last_mng', 'asc')
                ->paginate(10);

        }
        /*
         *  Si el Vendedor no tiene Clientes Pendientes por Gestionar
         *  Cargamos todos los clientes del Vendedor
         */
        if($customers->count() == 0) {
            Flash::error('No Posee Clientes Asociados!!');
        }

        return view('home')
            ->with('customers', $customers);

    }
}
