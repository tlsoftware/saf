<?php

namespace App\Http\Controllers;

use App\Detail;
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

    public function show()
    {
        $potencial_ids = Detail::getPotentials();
        // $status = 'Clientes Potenciales';

        if (Auth::user()->admin)
        {
            $customers = Customer::whereIn('status_detail_id', $potencial_ids)
                //->where('next_mng', '>', Carbon::now())
                ->orderBy('next_mng', 'asc')
                ->orderBY('last_mng', 'asc')
                ->get();

        }

        // Si es Vendedor carga solo los clientes pendientes de ese Vendedor
        else {
            $customers = Customer::where('user_id', Auth::user()->id)
                ->whereIn('status_detail_id', $potencial_ids)
                ->orderBy('next_mng', 'asc')
                ->orderBY('last_mng', 'asc')
                ->get();

        }
            /*
             *  Si el Vendedor no tiene Clientes Pendientes por Gestionar
             *  Cargamos todos los clientes del Vendedor
             */
        if($customers->count() == 0) {
            Flash::error('No Posee Potenciales Clientes Asociados!!');
        }

        /*
        return view('potenciales.show')
            ->with('customers', $customers);
        */
        return view('potenciales.show')
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
