<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Customer;
use App\Management;
use Laracasts\Flash\Flash;

class ActivoCustomerController extends Controller
{
    public function index($id)
    {
        $customer = Customer::find($id);

        $managements = Management::where('customer_id', $id)
            ->orderBY('created_at', 'DESC')
            ->limit(3)
            ->get();

        return view('activos.index')
            ->with('customer', $customer)
            ->with(compact('managements', $managements));
    }

    public function show(Request $request)
    {
        if (Auth::user()->admin)
        {
            $customers = Customer::Search($request->name)
                ->where('status', '4')
                ->orderBy('next_mng', 'asc')
                ->orderBY('last_mng', 'asc')
                ->paginate(10);

        }

        // Si es Vendedor carga solo los clientes pendientes de ese Vendedor
        else {
            $customers = Customer::Search($request->name)
                ->where('user_id', Auth::user()->id)
                ->where('status', '4')
                ->orderBy('next_mng', 'asc')
                ->orderBY('last_mng', 'asc')
                ->paginate(10);

        }
        /*
         *  Si el Vendedor no tiene Clientes Pendientes por Gestionar
         *  Cargamos todos los clientes del Vendedor
         */
        if($customers->count() == 0) {
            Flash::error('No Posee Clientes Activos!!');
            return redirect()->route('home');
        }

        /* return view('activos.show')
            ->with('customers', $customers);

        */
        return view('home')
            ->with('customers', $customers);
    }
}
