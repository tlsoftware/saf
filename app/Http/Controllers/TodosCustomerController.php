<?php

namespace App\Http\Controllers;

use App\Detail;
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
        if (Auth::user()->isAdmin() or Auth::user()->isSupervisor())
        {
            $customers = Customer::orderBy('next_mng', 'asc')
                ->orderBY('last_mng', 'asc')
                ->get();

        }

        else {
            $customers = Customer::where('user_id', Auth::user()->id)
                // ->where('status', '4')
                ->whereNotIn('status_detail_id', Detail::getRejected())
                ->whereNotIn('status_detail_id', Detail::getLowCustomer())
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
