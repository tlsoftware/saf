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
        // Guardamos la Nueva Gestion
        $management->save();

        $customer = Customer::find($id);

        $dt = Carbon::now();
        $dt->addWeekdays(7);

        $status = 1;
        if ($management->product != "")
            $status = 2;


        $customer->update(['next_mng' => $dt, 'status' => $status]);

        Flash::success("Se ha agregado una Nueva Gestion de forma exitosa!!");

        return redirect()->action('CustomerController@show', $customer->id);

    }

    public function create($id)
    {
        $customer = Customer::find($id);

        return view('managements.create')
            ->with(compact('customer', $customer));
    }
}
