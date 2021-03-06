<?php

namespace App\Http\Controllers;

use App\Bstype;
use App\Contact;
use App\Email;
use App\Phone;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        return view('customers.index')->with('customers', $customers);
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

        return view('customers.create')
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

        $this->validate($request, [
            'phone1' => [
                'regex:/^\+56[9|2|3|7][0-9]{8}$/',
            ],
            'phone2' => [
                'regex:/^\+56[9|2|3|7][0-9]{8}$/',
            ],
            'phone3' => [
                'regex:/^\+56[9|2|3|7][0-9]{8}$/',
            ],
            'name' => 'required|unique:customers'
        ]);



        $customer_ws = $this->remove_spaces($request->name);
        $customer_exists = count(DB::select("select * from customers where replace(name, ' ', '') like '$customer_ws'")) > 0 ? true : false;
        $customer_wa = $this->stripAccents($request->name);
        $customer_wa = $this->remove_spaces($customer_wa);

        if ($this->customer_exist($customer_ws) or $this->customer_exist($customer_wa) or $customer_exists) {
            Flash::Error("Cliente Existente! No Se ha registrado el cliente!!");
            return redirect()->back();
        }

        DB::beginTransaction();

        try {
            $customer = new Customer($request->all());
            $customer->next_mng = Carbon::now();

            if(!$request->user_id)
                $customer->user_id = Auth::user()->id;

            $customer->status_detail_id = 1;
            $customer->save();

            $contact = new Contact();
            $contact->name = $request->contact_name;
            $contact->position = $request->position;
            $contact->customer_id = $customer->id;
            $contact->save();

            $phone = new Phone($request->all());
            $phone->contact_id = $contact->id;
            $phone->save();

            $email = new Email($request->all());
            $email->contact_id = $contact->id;
            $email->save();

            DB::commit();

            Flash::success("Se ha registrado el cliente de forma exitosa!!");

            return redirect()->action('HomeController@index');

        } catch (\Exception $exception) {
            DB::rollBack();

            Flash::Error("No se ha podido crear el Cliente de forma Exitosa! " . $exception);

            return redirect()->back();
        }
    }

    public function customer_exist($new_customer)
    {

        return Customer::whereName($new_customer)->count() > 0 ? true : false;
    }

    public function stripAccents($str) {
        return strtr(utf8_decode($str), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
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

        return view('customers.show')
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

        return view('customers.edit')
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

    public function remove_spaces($new_customer) {

        $new_customer = str_replace(["\r", "\n", "\t"], " ", $new_customer);
        while (strpos($new_customer, " ") !== false)
        {
            $new_customer = str_replace(" ", "", $new_customer);
        }

        return $new_customer;
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
