<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CobranzasController extends Controller
{
    public function index()
    {
        $q_customers = Customer::where('status_detail_id', '=', 34);

        if (! Auth::user()->isAdmin() and ! Auth::user()->isSupervisor()) {
            $q_customers->where('user_id', '=', Auth::user()->id);
        }

        $customers = $q_customers->orderBy('next_mng')->get();

        return view('cobranzas')->with('customers', $customers);
    }
}
