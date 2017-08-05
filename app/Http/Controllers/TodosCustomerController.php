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
        $q_customers_id = Customer::where('id', '>', 0);
        if (! Auth::user()->isAdmin() and ! Auth::user()->isSupervisor())
            $q_customers_id = Customer::where('user_id', Auth::user()->id)
                ->whereNotIn('status_detail_id', Detail::getLowCustomer());

        $customers_id = $q_customers_id->orderBy('next_mng', 'asc')
                ->orderBY('last_mng', 'asc')
                ->pluck('id');

        $customers = collect();
        /*
         *  Si el Vendedor no tiene Clientes
         */
        if($customers_id->count() == 0) {
            Flash::error('No Posee Clientes Asociados!!');
        } else {
            foreach ($customers_id as $id)
            {
                $customer = Customer::find($id);
                $customer->last_mng = $this->getLastManagementDate($customer);
                $customer->next_mng = $this->getNextManagementDate($customer);
                $customers->push($customer);
            }
        }

        return view('todos.show')
            ->with('customers', $customers);
    }

    public function getLastManagementDate($customer)
    {
        if($customer->managements->count())
            return \Carbon\Carbon::parse($customer->managements->last()->created_at)->format('d-m-Y');
        else
            return  \Carbon\Carbon::parse('00-00-0000')->format('d-m-Y');
    }

    public function getNextManagementDate($customer)
    {
        return \Carbon\Carbon::parse($customer->next_mng)->format('d-m-Y');
    }
}
