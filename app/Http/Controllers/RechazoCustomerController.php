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

        $q_customers_id = Customer::whereIn('status_detail_id', $rechazo_ids);

        // Si es Vendedor carga solo los clientes pendientes de ese Vendedor
        if (! Auth::user()->isAdmin() and ! Auth::user()->isSupervisor())
            $q_customers_id->where('user_id', Auth::user()->id);

        $customers_id = $q_customers_id->orderBy('next_mng', 'asc')
            ->orderBY('last_mng', 'asc')
            ->pluck('id');

        $customers = collect();

        /*
         *  Si el Vendedor no tiene Clientes Pendientes por Gestionar
         */
        if($customers_id->count() == 0) {
            Flash::error('No Posee Clientes en Rechazos!!');
        } else {
            foreach ($customers_id as $id)
            {
                $customer = Customer::find($id);
                $customer->last_mng = $this->getLastManagementDate($customer);
                $customer->next_mng = $this->getNextManagementDate($customer);
                $customers->push($customer);
            }
        }

        return view('rechazos.show')
            ->with('customers', $customers);
    }

    public function getLastManagementDate($customer)
    {
        if($customer->managements->count())
            return \Carbon\Carbon::parse($customer->managements->last()->created_at)->format('d-m-Y');
        else
            return  '00-00-0000';
    }

    public function getNextManagementDate($customer)
    {
        return \Carbon\Carbon::parse($customer->next_mng)->format('d-m-Y');
    }
}
