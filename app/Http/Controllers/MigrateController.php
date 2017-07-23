<?php

namespace App\Http\Controllers;

use App\Customer;
use App\User;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class MigrateController extends Controller
{
    public function index($id)
    {
        $user = User::find($id);
        $users2 = User::pluck('name', 'id')->toArray();

        $customers = Customer::whereUserId($id)->get();

        return view('admin.migrate.index')
            ->with(compact('users2', $users2))
            ->with('customers', $customers)
            ->with('user', $user);
    }

    public function update(Request $request)
    {
        $customers = $request->customer;
        $user_id = $request->user2_id;

        foreach ($customers as $customer) {
            Customer::whereId($customer)
                ->update(['user_id' => $user_id]);
        }

        Flash::success('Se migraron los Clientes con Exito!!');

        return redirect()->route('users.index');
    }
}
