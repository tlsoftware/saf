<?php

namespace App\Http\Controllers;

use App\Bstype;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = Customer::Search($request->name)
            ->orderBy('next_mng', 'asc')
            ->paginate(5);

        return view('admin.customers.index')
            ->with('customers', $customers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::pluck('name', 'id')->toArray();
        $bstypes = Bstype::pluck('type', 'id')->toArray();

        return view('admin.customers.create')
            ->with(compact('users', $users))
            ->with(compact('bstypes', $bstypes));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = new Customer($request->all());
        $customer->next_mng = Carbon::now();

        if(!$request->user_id)
            $customer->user_id = Auth::user()->id;

        $customer->save();

        Flash::success("Se ha registrado el cliente de forma exitosa!!");

        return redirect()->action('HomeController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        $managements = $customer->managements;

        return view('admin.customers.show')
            ->with('customer', $customer)
            ->with(compact('managements', $managements));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        $customer->user;

        $users = User::pluck('name', 'id')->toArray();

        return view('admin.customers.edit')
            ->with('customer', $customer)
            ->with(compact('users', $users));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->fill($request->all());
        $customer->save();
        /*
         *  $user->name = $request->name;
         *  $user->email = $request->email;
         *  $user->role = $request->role;
        */

        Flash::warning('EL Cliente ha sido editado con Exito!!');

        return redirect()->route('customers.show', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
