<?php

namespace App\Http\Controllers;

use App\Bstype;
use App\Contact;
use App\Detail;
use App\Email;
use App\Phone;
use App\Product;
use App\Sale;
use App\Status;
use DateTime;
use Illuminate\Http\Request;
use App\Management;
use App\Customer;
use App\User;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use Carbon\Carbon;
use Auth;
use View;

class ManagementController extends Controller
{
    public function store(Request $request, $id)
    {
        // $description = $request->description;
        $status_detail_id = $request->status_detail_id;
        $status_id = $request->status_id;
        $status = Detail::find($status_detail_id)->status_id;
        $status2 = $request->status;
        /*
        $this->validate($request, [
            'next_mng' => 'after:today|required',
        ]);

        if ($status2 == 1)
            $this->validate($request, [
                'dispatch_date' => 'after:yesterday',
                'product_id'    => 'required'
            ]);
        */

        DB::beginTransaction();

        try {
            $management = new Management($request->all());
            if ($management->dispatch_date != '') {
                $management->dispatch_date = $this->DateConvertEsToUs($management->dispatch_date);
            }
            $management->customer_id = $id;
            $management->user_id = Auth::user()->id;
            $management->status_detail_id = $status_detail_id;
            $management->save();

            if ($status_detail_id == 17 or $status_detail_id == 27) {
                // Se esta Agregando una Muestra
                foreach ($request->product_id as $product) {
                    $sale = new Sale();
                    $sale->quantity = $request->quantity;
                    $sale->price = $request->price;
                    $sale->management_id = $management->id;
                    $sale->product_id = $product;
                    $sale->type = $status_detail_id == 17 ? 0 : 1;
                    $sale->save();
                }
            }

            $next = '2100-12-31';
            // Determinar si la fecha ingresada por el Usuario es Vacia o Mayor a 7 dias
            if ($request->next_mng != '') {
                $next = $this->DateConvertEsToUs($request->next_mng);
            } else if ($status_id != 5 && $status_id != 3){
                $next = Carbon::now()->addWeekdays(7)->format('Y-m-d');
            }

            $customer = Customer::find($id);
            $data = array(
                'status_detail_id' => $status_detail_id,
                'next_mng' => $next,
                'last_mng' => Carbon::now(),
                'ctype'    => $request->ctype
            );

            $customer->update($data);

            DB::commit();

            Flash::success("Se ha agregado una Nueva Gestion de forma exitosa!!");

            return redirect()->back();

        } catch (\Exception $exception) {
            DB::rollBack();
            Flash::error("No se ha podido agregar Gestion!!");

            return redirect()->back();
        }


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
        $previous_url = url()->previous();
        $customer = Customer::find($id);
        $status_id = $customer->status_detail->status->id;

        /*
        $status_detail_ids = ($previous_url == route('home')) ?
            Detail::getStatusDetailIdHome()->toArray() :
            Detail::where('status_id', $status_id)->pluck('id')->toArray();
        */

        $status_detail_ids = Detail::getStatusDetailIdHome()->toArray();

        $management_id = Management::whereCustomerId($id)->pluck('id');
        $sale = (Sale::whereIn('management_id', $management_id)->whereType(1)->latest()->first()) ?: false;

        $q_customers_id = DB::table('customers')
            ->join('statuses_details', 'customers.status_detail_id', '=', 'statuses_details.id')
            ->where('customers.next_mng', '<=', Carbon::now())
            ->whereIn('customers.status_detail_id', $status_detail_ids)
            ->select('customers.id');

        if (! Auth::user()->isAdmin() and ! Auth::user()->isSupervisor()) {
            $q_customers_id->where('customers.user_id', '=', Auth::user()->id);
        }

        $customers_id = $q_customers_id->orderBy('statuses_details.priority' ,'ASC')
            ->orderBy('customers.next_mng', 'ASC')
            ->orderBy('customers.last_mng', 'DESC')
            ->pluck('id');

        $customers = collect();
        foreach ($customers_id as $customer_id) {
            $customers->push(Customer::find($customer_id));
        }

        $customer_array = $customers->toArray();

        $keyed = $customers->keyBy('id')->all();
        // $keyed = $customers->keyBy('id')->keys();
        $current_key = $customers->where('id', '=', $id)->keys()->get(0);
        $key_plus = $current_key + 1;
        $key_minus = $current_key - 1;

        // dd($customers->where('id', '<', $id)->min('id'));
        $previous = $current_key == 0 ?
            end($customer_array)['id'] :
            $customer_array[$key_minus]['id'];

        $next = $current_key == count($customer_array) - 1 ?
            current($customer_array)['id'] :
            $customer_array[$key_plus]['id'];

        // $next = next($keyed)->id;
        // PERFIL ADMINISTRADOR
        /*
        if (Auth::user()->isAdmin()) {
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
        */

        $managements = Management::where('customer_id', $customer->id)
            ->orderBY('created_at', 'DESC')
            // ->limit('3')
            ->get();


            $users = User::pluck('name', 'id')->toArray();
            return View::make('managements.show')
                ->with('previous', $previous)
                ->with('next', $next)
                ->with('customer', $customer)
                ->with(compact('managements', $managements))
                ->with(compact('users', $users))
                ->with('sale', $sale);

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
        $statuses_detail = Detail::where('status_id', '=',2)->pluck('name', 'id')->toArray();

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
                ->with(compact('products', $products))
                ->with(compact('statuses_detail', $statuses_detail));
        }

        return View::make('managements.showmuestra')
            ->with('customer', $customer)
            ->with(compact('managements', $managements))
            ->with(compact('products', $products))
            ->with(compact('statuses_detail', $statuses_detail));
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

        $this->validate($request, [
            'phone1' => [
                'regex:/^\+56[9|2|3|7][0-9]{8}$/',
            ],
            'phone2' => [
                'regex:/^\+56[9|2|3|7][0-9]{8}$/',
            ],
            'phone3' => [
                'regex:/^\+56[9|2|3|7][0-9]{8}$/',
            ]
        ]);


        DB::beginTransaction();

        try {
            $customer = Customer::find($id);
            $customer->fill($request->all());

            if (! $mng = Management::where('customer_id', $id)->first()) {
                $customer->status_detail_id = 2;
            }

            $customer->save();

            $management = new Management();
            $management->customer_id = $id;
            $management->user_id = Auth::user()->id;
            $management->description = "Se actualizaron datos de Contacto";
            // $management->st_details = $st_details;
            // $management->product_id = null;
            $management->status_detail_id = $customer->status_detail_id;
            $management->save();

            $contact = Contact::find($customer->contact->id);
            $contact->name = $request->contact;
            $contact->position = $request->position;
            $contact->save();

            $phone = Phone::find($customer->contact->phone->id);
            $phone->fill($request->all());
            $phone->save();

            $email = Email::find($customer->contact->email->id);
            $email->fill($request->all());
            $email->save();

            DB::commit();

            Flash::success("Se actualizaron los datos Satisfactoriamente!!");
            return redirect()->back();
        } catch (\Exception $exception) {
            DB::rollBack();
            Flash::error("Se produjo un Error Actualizando los Datos!!");
            return redirect()->back();

        }
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

    public function DateConvertEsToUs($date)
    {
        $usDate = explode( '/', $date );

        return $usDate[2]."-".$usDate[1]."-".$usDate[0];
    }

    public function DateConvertUsToEs($date)
    {
        $esDate = explode( '-', $date );

        return $esDate[2]."/".$esDate[1]."/".$esDate[0];
    }


    public function dailyManagement(Request $request)
    {
        $date_from = $request->get('date_from');
        $date_to = $request->get('date_to');
        $vendor = intval($request->get('vendor'));

        if ($date_from == '' or $date_to == '') {
            $today = date('Y-m-d');
            $fecha1 = $today;
            $fecha2 = $today;
        } else {
            $fecha1 = $this->DateConvertEsToUs($date_from);
            $fecha2 = $this->DateConvertEsToUs($date_to);
        }
        $query = Management::whereBetween('created_at', [$fecha1 . ' 00:00:00', $fecha2 . ' 23:59:59']);

        $managements = $vendor == '' || $vendor == 0 ? $query->get() : $query->whereUserId($vendor)->get();

        $vendors = collect([0 => '-- Todos --']);
        $users = User::pluck('name', 'id');

        $vendors->push($users);

        return view('supervisor.gestiones.index')
            ->with('managements', $managements)
            ->with('users', $vendors->toArray())
            ->with('date_from', $this->DateConvertUsToEs($fecha1))
            ->with('date_to', $this->DateConvertUsToEs($fecha2))
            ->with('vendor', $vendor);
    }

}
