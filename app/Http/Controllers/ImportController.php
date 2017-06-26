<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Customer;
use App\Detail;
use App\Email;
use App\Management;
use App\Phone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    protected $load_file = "";
    protected $delimiter  = ';';

    public function index()
    {
        return view('admin.upload');
    }

    public function uploadFile(Request $request)
    {
        $file = $request->file;
        $name =  $file->getClientOriginalName();
        $extension = $request->file->extension();

        /*
        if ($extension !== 'txt') {
            return back()->with('error', 'Extension Invalida! La extension del Archivo debe ser CSV');
        }
        */

        if (! \Storage::disk('local')->put($name,  \File::get($file))) {
            return back()->with('error', 'Error Cargando Archivo!');
        }

        $this->load_file = public_path() . '/uploads/' . $name;

        if (! $this->importData()) {
            return back()->with('error', 'Error Ingresando Datos en la Base de Datos!');
        }

        flash('Datos Cargados Satisfactoriamente!', 'success');
        return redirect()->route('home');
    }

    public function importData()
    {
        DB::transaction(function () {


            Excel::load($this->load_file, function($reader) {

                // $reader->skip(6);
                $reader->take(10);
                // DB::enableQueryLog();

                foreach ($reader->get() as $customer) {

                    $newCustomer = new Customer();
                    $management = new Management();
                    $newCustomer->rut = $customer->rut;
                    $newCustomer->bs_name = $customer->razon_social;
                    $newCustomer->name = $customer->nombre_fantasia;
                    $newCustomer->address = $customer->direccion;
                    $newCustomer->commune = $customer->comuna;
                    $newCustomer->city = $customer->ciudad;
                    $newCustomer->web = $customer->web;

                    if (strtolower(trim($customer->estatus)) == 'cerrado') {
                        $customer->estatus = 'Otros';
                    } else if (strtolower(trim($customer->estatus)) == 'concentrado') {
                        $customer->estatus = 'Usan Concentrado';
                    } else if (strtolower(trim($customer->estatus)) == 'gestion') {
                        $customer->estatus = 'En Gestion';
                    } else if (strtolower(trim($customer->estatus)) == 'muestras') {
                        $customer->estatus = 'Sin Contactar';
                    } else if (strtolower(trim($customer->estatus)) == 'envia lista de precio') {
                        $customer->estatus = 'Envia lista de Precios';
                    } else if ($customer->estatus == '') {
                        $customer->estatus = 'Sin Gestion';
                    }
                    // dd($customer->estatus);
                    $status_detail_id = Detail::where('name', strtolower($customer->estatus))->pluck('id')->toArray();

                    if ($status_detail_id) {
                        $newCustomer->status_detail_id = $status_detail_id[0];
                    } else {
                        // dd($status_detail_id);
                        dd($customer->estatus);
                    }
                    /*
                    Agregado: Potencial Cliente.
                    Cerrado (Otras): Baja
                    Concentrado (Usan Concentrado): Rechazos.
                    Correo por Confirmar: Potencial Cliente.
                    Devuelto: Potencial Cliente
                    En Gestion: Potencial Cliente
                    Envia lista de Precios: Potencial Cliente
                    Envio de Catalogo: Potencial Cliente.
                    Futuros Productos (En Gestión): Potencial Cliente.
                    Gestion: Potencial Cliente.
                    Muestras (Sin contactar): Muestras.
                    No Contesta (En Gestión): Potencial Cliente.
                    Posible (En Gestión): Potencial Cliente.
                    Rechazado: Rechazo
                    Venta: Activos
                    */

                    $last_mng = $this->handleDate($customer->ultimo_contacto);
                    // $newCustomer->next_mng = Carbon::now('America/Santiago');
                    // $newCustomer->next_mng = $this->handleDate($customer->fecha_proxima_gestion);

                    $newCustomer->next_mng = $this->handleDate(Carbon::now()->addWeekdays(7)->format('Y-m-d'));

                    $user_id = 2;
                    // $user_id = 1;

                    if (trim($customer->vendedor) == 'Maria' || trim($customer->vendedor) == 'María')
                        $user_id = 3;
                    if (trim($customer->vendedor) == 'Dayanna')
                        $user_id = 4;

                    switch (ucfirst(strtolower($customer->clasificacion_restaurant))) {
                        case 'Pizzeria' :
                            $id = 1;
                            break;
                        case 'Italiana' :
                            $id = 2;
                            break;
                        case 'Bar' :
                            $id = 3;
                            break;
                        case 'Bazar' :
                            $id = 4;
                            break;
                        case 'Cafe' :
                            $id = 5;
                            break;
                        case 'Carnes' :
                            $id = 6;
                            break;
                        case 'Cerveceria' :
                            $id = 8;
                            break;
                        case 'Comida' :
                            $id = 9;
                            break;
                        case 'Comidas' :
                            $id = 10;
                            break;
                        case 'Distribuidora' :
                            $id = 11;
                            break;
                        case 'Empanadas' :
                            $id = 12;
                            break;
                        case 'Fabrica' :
                            $id = 13;
                            break;
                        case 'Hotel' :
                            $id = 14;
                            break;
                        case 'Pastas' :
                            $id = 15;
                            break;
                        case 'Restaurant' :
                            $id = 16;
                            break;
                        case 'Varios' :
                            $id = 17;
                            break;
                        case 'Vegetariano' :
                            $id = 18;
                            break;
                        default:
                            $id = 17;
                    }
                    $newCustomer->user_id = $user_id;
                    $newCustomer->bstype_id = $id;

                    if ($customer->seguimiento == null)
                    {
                        $customer->seguimiento = "No tiene descripcion en la Gestion";
                    }
                    $created_at = $this->handleDate(substr($customer->seguimiento, 0, 10));

                    $management->description = $customer->seguimiento;
                    $management->created_at = new Carbon($last_mng, 'America/Santiago');
                    $management->user_id = $user_id;
                    $newCustomer->created_at = $created_at;
                    $newCustomer->save();
                    // DB::disableQueryLog();
                    $newCustomer->managements()->save($management);

                    $contact = new Contact();
                    $phone = new Phone();
                    $email = new Email();

                    $contact->name = $customer->nombre . ' ' . $customer->apellido;
                    $contact->position = $customer->cargo;
                    $contact->customer_id = $newCustomer->id;
                    $contact->save();


                    $phone->phone1 = ($customer->telefono_1 != null) ? $this->strTrim('+56' . $customer->telefono_1) : null;
                    $phone->phone2 = ($customer->telefono_2 != null) ? $this->strTrim('+56' . $customer->telefono_2) : null;
                    $phone->phone3 = ($customer->telefono_3 != null) ? $this->strTrim('+56' . $customer->telefono_3) : null;
                    $phone->contact_id = $contact->id;
                    $contact->save();

                    $email->email1 = $customer->correo;
                    $email->email2 = $customer->correo_2;
                    $email->email3 = $customer->correo_3;
                    $email->contact_id = $contact->id;
                    $contact->save();
                }

            });
        });

        return true;

    }

    public function strTrim($word)
    {
        return preg_replace('/\s+/', '', $word);
    }

    public function handleDate($date)
    {
        if ($date === null || ctype_alpha(substr($date, 0, 2))) {
            $date = '21/06/2017';
        }

        $delimiter = (! strpos($date, '/'))
            ? '-' : '/';

        $date_formated = explode($delimiter, $date);

        try {
            if ($date_formated[1] > 12) {
                $aux = $date_formated[0];
                $date_formated[0] = $date_formated[1];
                $date_formated[1] = $aux;
            }

            $day = str_pad($date_formated[0], 2, 0, STR_PAD_LEFT);
            $month = str_pad($date_formated[1], 2, 0, STR_PAD_LEFT);
            $year = $date_formated[2];
            if(strlen($year) == 2)
                $year = '20' . $date_formated[2];

            $dateFormated = $year . '-' . $month . '-' . $day;

            return new Carbon($dateFormated, 'America/Santiago');

            // dd($newCustomer->last_mng);
        } catch (\Exception $e) {
            // echo $e;
            return Carbon::now('America/Santiago');
        }

        return true;
    }
}
