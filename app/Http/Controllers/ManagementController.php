<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Management;
use App\Customer;
use Laracasts\Flash\Flash;
use Carbon\Carbon;

class ManagementController extends Controller
{
    public function store(Request $request, $id)
    {
        $management = new Management($request->all());
        $management->customer_id = $id;
        $management->save();

        // Determinar si la fecha ingresada por el Usuario es Vacia o Mayor a 7 dias
        $next = $request->next_mng;
        $status = $request->status;

        if($next == '') {
            if ($status < 3) {
                $dt = Carbon::now()->addWeekdays(7)->format('Y-m-d');
            } else {
                $dt = Carbon::now()->addWeekdays(15)->format('Y-m-d');
            }
            $next = $dt;
        }

        $customer = Customer::find($id);
        $customer->next_mng = $next;
        $customer->status = $status;

        $customer->update(['next_mng' => $next, 'status' => $status,
            'phone2' => $request->phone2, 'phone3' => $request->phone3,
            'email2' => $request->email2, 'email3' => $request->email3]);

        Flash::success("Se ha agregado una Nueva Gestion de forma exitosa!!");

        if ($status == 1 ) {
            return redirect()->action('PotencialCustomerController@show');
        } elseif ($status == 2) {
            return redirect()->action('MuestraCustomerController@show');
        } elseif ($status == 3) {
            return redirect()->action('ActivoCustomerController@show');
        }

        return redirect()->action('HomeCustomerController@index');
    }

    public function create($id)
    {
        $customer = Customer::find($id);

        return view('managements.create')
            ->with(compact('customer', $customer));
    }
}
