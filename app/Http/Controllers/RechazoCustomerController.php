<?php

namespace App\Http\Controllers;

use App\Detail;
use Auth;
use App\Customer;
use Laracasts\Flash\Flash;

class RechazoCustomerController extends Controller
{
    public function show()
    {
        $rechazo_ids   = Detail::getRejected();

        if (Auth::user()->admin)
        {
            $customers = Customer::whereIn('status_detail_id', $rechazo_ids)
                // ->where('next_mng', '>', Carbon::now())
                ->orderBy('next_mng', 'asc')
                ->orderBY('last_mng', 'asc')
                ->get();

        }

        // Si es Vendedor carga solo los clientes pendientes de ese Vendedor
        else {
            $customers = Customer::where('user_id', Auth::user()->id)
                ->whereIn('status_detail_id', $rechazo_ids)
                ->orderBy('next_mng', 'asc')
                ->orderBY('last_mng', 'asc')
                ->get();

        }
        /*
         *  Si el Vendedor no tiene Clientes Pendientes por Gestionar
         *  Cargamos todos los clientes del Vendedor
         */
        if($customers->count() == 0) {
            Flash::error('No Posee Clientes en Rechazos!!');
            return redirect()->route('home');
        }

        return view('rechazos.show')
            ->with('customers', $customers);

    }
}
