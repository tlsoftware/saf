<?php

namespace App\Http\Controllers;

use App\Bstype;
use App\Detail;
use App\Product;
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
        $status = $request->status_id;
        // $description = $request->description;
        $status_detail_id = $request->status_detail_id;

        if (! ($status == '3' || $status == '5'))
            $this->validate($request, [
                'next_mng' => 'after:today|required',
                'dispatch_date' => 'after:yesterday',
            ]);

        $management = new Management($request->all());
        $management->customer_id = $id;
        $management->user_id = Auth::user()->id;
        $management->save();

        // Determinar si la fecha ingresada por el Usuario es Vacia o Mayor a 7 dias
        $next = $request->next_mng;

        if($next == '') {
            $next = Carbon::now()->addWeekdays(7)->format('Y-m-d');
        }

        $customer = Customer::find($id);
        $next_mng = $next;
        $last_mng = Carbon::now();

        $data = array(
            'status' => $status_detail_id,
            'next_mng' => $next_mng,
            'last_mng' => $last_mng
        );

        $customer->update($data);

        Flash::success("Se ha agregado una Nueva Gestion de forma exitosa!!");

        return redirect()->action('HomeController@index');
    }

    public function create($id)
    {
        $customer = Customer::find($id);

        return view('managements.create')
            ->with(compact('customer', $customer));
    }


    // MOSTRAR CLIENTES CON OPCIONES DE GESTION
    public function show($id)
    {
        $customer = Customer::find($id);
        $status_id = $customer->status_detail->status->id;
        $status_detail_ids = Detail::where('status_id', $status_id)->pluck('id')->toArray();

        // PERFIL ADMINISTRADOR
        if (Auth::user()->admin) {
            // Get Previous Customer ID
            $previous = Customer::where('id', '<', $customer->id)
                ->whereIn('status_detail_id', $status_detail_ids)
                ->max('id');

            // Get Next Customer ID
            $next = Customer::where('id', '>', $customer->id)
                ->whereIn('status_detail_id', $status_detail_ids)
                ->min('id');
        } else {
            // Get Previous Customer ID
            $previous = Customer::where('id', '<', $customer->id)
                ->where('user_id', Auth::user()->id)
                ->whereIn('status_detail_id', $status_detail_ids)
                ->max('id');

            // Get Next Customer ID
            $next = Customer::where('id', '>', $customer->id)
                ->where('user_id', Auth::user()->id)
                ->whereIn('status_detail_id', $status_detail_ids)
                ->min('id');
        }

        // Redireccionar al Primero
        if (!$next) {
            $next = Customer::first()
                ->whereIn('status_detail_id', $status_detail_ids)
                ->min('id');
        }
        // Redireccionar al Ultimo
        if (!$previous) {
            $previous = Customer::latest()
                ->whereIn('status_detail_id', $status_detail_ids)
                ->max('id');
        }

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

        return View::make('managements.show')
            ->with('previous', $previous)
            ->with('next', $next)
            ->with('customer', $customer)
            ->with(compact('managements', $managements));
    }

    public function showGestion($id)
    {
        $customer = Customer::find($id);

        $managements = Management::latest()
            ->where('customer_id', $customer->id)
            ->limit(1)
            ->get();

        if(Auth::user()->admin) {
            $users = User::pluck('name', 'id')->toArray();
            return View::make('managements.showgestion')
                ->with('customer', $customer)
                ->with(compact('managements', $managements))
                ->with(compact('users', $users));
        }

        return View::make('managements.showgestion')
            ->with('customer', $customer)
            ->with(compact('managements', $managements));
    }

    public function showMuestra($id)
    {
        $customer = Customer::find($id);
        $products = Product::pluck('name', 'id')->toArray();

        $managements = Management::where('customer_id', $customer->id)
            ->orderBY('created_at', 'DESC')
            ->limit('1')
            ->get();

        if(Auth::user()->admin) {
            $users = User::pluck('name', 'id')->toArray();
            return View::make('managements.showmuestra')
                ->with('customer', $customer)
                ->with(compact('managements', $managements))
                ->with(compact('users', $users))
                ->with(compact('products', $products));
        }

        return View::make('managements.showmuestra')
            ->with('customer', $customer)
            ->with(compact('managements', $managements))
            ->with(compact('products', $products));
    }

    public function showDatos($id)
    {
        $customer = Customer::find($id);

        $managements = Management::where('customer_id', $customer->id)
            ->orderBY('created_at', 'DESC')
            ->limit('1')
            ->get();

        if(Auth::user()->admin) {
            $users = User::pluck('name', 'id')->toArray();
            return View::make('managements.showdatos')
                ->with('customer', $customer)
                ->with(compact('managements', $managements))
                ->with(compact('users', $users));
        }

        return View::make('managements.showdatos')
            ->with('customer', $customer)
            ->with(compact('managements', $managements));
    }

    public function storeDatos(Request $request, $id)
    {
        
        $customer = Customer::find($id);

        $this->validate($request, [
            'phone2' => [
                'regex:/^\+56[9|2][0-9]{8}$/',
            ],
            'phone3' => [
                'regex:/^\+56[9|2][0-9]{8}$/',
            ]
        ]);

        $customer->fill($request->all());

        if (! $mng = Management::where('customer_id', $id)->first()) {
            $st_details = 'En Gestion'; 
            $customer->status = '1';
        } else {
            $st_details = $mng->st_details;
        } 

        $management = new Management();
        $management->customer_id = $id;
        $management->user_id = Auth::user()->id;
        $management->description = "Se actualizaron datos de Contacto";
        $management->st_details = $st_details;
        $management->product_id = null;

        if ($management->save()) {
            $customer->save();
        }

        return redirect()->action('HomeController@index');
    }

    public function showVenta($id)
    {
        $customer = Customer::find($id);
        $products = Product::pluck('name', 'id')->toArray();

        $managements = Management::where('customer_id', $customer->id)
            ->orderBY('created_at', 'DESC')
            ->limit('1')
            ->get();

        if(Auth::user()->admin) {
            $users = User::pluck('name', 'id')->toArray();
            return View::make('managements.showventa')
                ->with('customer', $customer)
                ->with(compact('managements', $managements))
                ->with(compact('users', $users))
                ->with(compact('products', $products));
        }

        return View::make('managements.showventa')
            ->with('customer', $customer)
            ->with(compact('managements', $managements))
            ->with(compact('products', $products));
    }

    public function showRechazo($id)
    {
        $customer = Customer::find($id);
        $products = Product::pluck('name', 'id')->toArray();

        $managements = Management::where('customer_id', $customer->id)
            ->orderBY('created_at', 'DESC')
            ->limit('1')
            ->get();

        if(Auth::user()->admin) {
            $users = User::pluck('name', 'id')->toArray();
            return View::make('managements.showrechazo')
                ->with('customer', $customer)
                ->with(compact('managements', $managements))
                ->with(compact('users', $users))
                ->with(compact('products', $products));
        }

        return View::make('managements.showrechazo')
            ->with('customer', $customer)
            ->with(compact('managements', $managements))
            ->with(compact('products', $products));
    }

    public function showBaja($id)
    {
        $customer = Customer::find($id);
        $products = Product::pluck('name', 'id')->toArray();

        $managements = Management::where('customer_id', $customer->id)
            ->orderBY('created_at', 'DESC')
            ->limit('1')
            ->get();

        if(Auth::user()->admin) {
            $users = User::pluck('name', 'id')->toArray();
            return View::make('managements.showbaja')
                ->with('customer', $customer)
                ->with(compact('managements', $managements))
                ->with(compact('users', $users))
                ->with(compact('products', $products));
        }

        return View::make('managements.showbaja')
            ->with('customer', $customer)
            ->with(compact('managements', $managements))
            ->with(compact('products', $products));
    }

}
