<?php

namespace App\Http\Controllers;

use App\Detail;
use Illuminate\Http\Request;
use Auth;
use App\Customer;
use App\Management;
use Laracasts\Flash\Flash;

class MuestraCustomerController extends Controller
{
    public function index($id)
    {
        $customer = Customer::find($id);

        $managements = Management::where('customer_id', $id)
            ->orderBY('created_at', 'DESC')
            ->limit('3')
            ->get();

        return view('muestras.index')
            ->with('customer', $customer)
            ->with('status', '2')
            ->with(compact('managements', $managements));
    }

    public function show()
    {
        $muestra_ids   = Detail::getSamples();

        if (Auth::user()->admin)
        {
            $customers = Customer::whereIn('status_detail_id', $muestra_ids)
                ->orderBy('next_mng', 'asc')
                ->orderBY('last_mng', 'asc')
                ->get();

        }

        // Si es Vendedor carga solo los clientes pendientes de ese Vendedor
        else {
            $customers = Customer::where('user_id', Auth::user()->id)
                ->whereIn('status_detail_id', $muestra_ids)
                ->orderBy('next_mng', 'asc')
                ->orderBY('last_mng', 'asc')
                ->get();

        }
        /*
         *  Si el Vendedor no tiene Clientes Pendientes por Gestionar
         *  Cargamos todos los clientes del Vendedor
         */
        if($customers->count() == 0) {
            Flash::error('No Posee Clientes con Muestras Entregadas!!');
            return view('muestras.show');
        }

        /*
        return view('muestras.show')
            ->with('customers', $customers);
        */

        return view('muestras.show')
            ->with('customers', $customers);
    }
}
