<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class PotencialCustomerController extends Controller
{
    public function index($id)
    {
        $customer = Customer::findOrFail($id);
        $managements = $customer->managements;

        return view('potencial')
            ->with('customer', $customer)
            ->with(compact('managements', $managements));
    }
}
