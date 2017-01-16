<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Customer;
use App\Management;
use App\User;
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
        if(Auth::user()->admin) {
            $users = User::pluck('name', 'id')->toArray();
            return view('potenciales.index')
                ->with('customer', $customer)
                ->with(compact('managements', $managements))
                ->with(compact('users', $users));
        }

        return view('potenciales.index')
            ->with('customer', $customer)
            ->with(compact('managements', $managements));
    }

    public function show(Request $request)
    {
        if (Auth::user()->admin)
        {
            $customers = Customer::Search($request->name)
                ->where('status', '1')
                ->where('next_mng', '>', Carbon::now())
                ->orderBy('next_mng', 'asc')
                ->orderBY('last_mng', 'asc')
                ->paginate(10);

        }

        // Si es Vendedor carga solo los clientes pendientes de ese Vendedor
        else {
            $customers = Customer::Search($request->name)
                ->where('user_id', Auth::user()->id)
                ->where('status', '1')
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

        /*
        return view('potenciales.show')
            ->with('customers', $customers);
        */
        return view('home')
            ->with('customers', $customers);
    }

    public function detalle($id)
    {
        $customer = Customer::find($id);

        $managements = Management::where('customer_id', $id)
            ->orderBY('created_at', 'DESC')
            ->get();

        return view('potenciales.detalle')
            ->with('customer', $customer)
            ->with(compact('managements', $managements));
    }
}
