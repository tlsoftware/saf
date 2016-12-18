<?php

namespace App\Http\Controllers;

use App\Bstype;
use Illuminate\Http\Request;
use App\Management;
use App\Customer;
use App\User;
use Laracasts\Flash\Flash;
use Carbon\Carbon;
use Auth;
use View;

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

    public function show($id)
    {
        $customer = Customer::find($id);

        // Get Previous Customer ID
        $previous = Customer::where('id', '<', $customer->id)->max('id');

        // Get Previous Customer ID
        $next = Customer::where('id', '>', $customer->id)->min('id');

        if (!$next) { // Redireccionar al Primero
            $next = Customer::first()->min('id');
        }

        if (!$previous) { // Redireccionar al Ultimo
            $previous = Customer::latest()->max('id');
        }

        // $customers = Customer::paginate(1);

        $managements = Management::where('customer_id', $customer->id)
            ->orderBY('created_at', 'DESC')
            ->limit('3')
            ->get();

        if(Auth::user()->admin) {
            $users = User::pluck('name', 'id')->toArray();
            return View::make('managements.show')
                ->with('previous', $previous)
                ->with('next', $next)
                ->with('customer', $customer)
                ->with(compact('managements', $managements))
                ->with(compact('users', $users));
        }

        return View::make('managements.index')
            ->with('previous', $previous)
            ->with('next', $next)
            ->with('customer', $customer)
            ->with(compact('managements', $managements));
    }
}
