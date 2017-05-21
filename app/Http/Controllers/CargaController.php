<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Management;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CargaController extends Controller
{

    public function loadExcel()
    {
        DB::transaction(function () {

            $file = public_path() . '/excel/base_de_datos_17052017.csv';


            Excel::load($file, function($reader) {

                // $reader->take(1);
                // DB::enableQueryLog();

                foreach ($reader->get() as $customer) {

                    // dd($customer->toArray());

                    $newCustomer = new Customer();
                    $management = new Management();
                    $newCustomer->rut = $customer->rut;
                    $newCustomer->bs_name = $customer->razon_social;
                    $newCustomer->name = $customer->nombre_fantasia;
                    $newCustomer->phone1 = ($customer->telefono_1 != null) ? '+56' . trim($customer->telefono_1) : null;
                    $newCustomer->phone2 = ($customer->telefono_2 != null) ? '+56' . trim($customer->telefono_2) : null;
                    $newCustomer->phone3 = ($customer->telefono_3 != null) ? '+56' . trim($customer->telefono_3) : null;
                    $newCustomer->contact_name = $customer->nombre . ' ' . $customer->apellido;
                    $newCustomer->position = $customer->cargo;
                    $newCustomer->email1 = $customer->correo;
                    $newCustomer->email2 = $customer->correo_2;
                    $newCustomer->email3 = $customer->correo_3;
                    $newCustomer->web = $customer->web;

                    $management->st_details = '0';

                    switch (strtolower($customer->estatus)) {
                        case 'rechazado':
                            $newCustomer->status = '3';

                            break;
                        case 'en gestion':
                            $newCustomer->status = '1';
                            break;
                        case 'en gestion ':
                            $newCustomer->status = '1';
                            break;
                        case 'gestion':
                            $newCustomer->status = '1';
                            break;
                        case 'no contesta':
                            $newCustomer->status = '1';
                            $management->st_details = '3';
                            break;
                        case 'correo por confirmar':
                            $newCustomer->status = '1';
                            break;
                        case 'devuelto':
                            $newCustomer->status = '1';
                            break;
                        case 'agregado':
                            $newCustomer->status = '1';
                            break;
                        case 'envia lista de precio':
                            $newCustomer->status = '1';
                            $management->st_details = '4';
                            break;
                        case 'envio de catalogo':
                            $newCustomer->status = '1';
                            $management->st_details = '4';
                            break;
                        case 'muestra':
                            $newCustomer->status = '2';
                            $management->st_details = '2';
                            break;
                        case 'no contesta':
                            $newCustomer->status = '1';
                            $management->st_details = '3';
                            break;
                        case 'posible':
                            $newCustomer->status = '1';
                            $management->st_details = '0';
                            break;
                        case 'venta':
                            $newCustomer->status = '4';
                            $management->st_details = '3';
                            break;
                        default:
                            $newCustomer->status = '1';

                    }

                    if ($customer->fecha_primer_contacto === null) {
                        $customer->fecha_primer_contacto = '21/05/2017';
                    }

                    $delimiter = (! strpos($customer->fecha_primer_contacto, '/'))
                        ? '-' : '/';

                    $date = explode($delimiter, $customer->fecha_primer_contacto);

                    try {
                        if ($date[1] > 12) {
                            $aux = $date[0];
                            $date[0] = $date[1];
                            $date[1] = $aux;
                        }

                        $day = str_pad($date[0], 2, 0, STR_PAD_LEFT);
                        $month = str_pad($date[1], 2, 0, STR_PAD_LEFT);
                        $year = $date[2];
                        if(strlen($year) == 2)
                            $year = '20' . $date[2];

                        $dateFormated = $year . '-' . $month . '-' . $day;

                        $newCustomer->last_mng = new Carbon($dateFormated, 'America/Santiago');
                        $newCustomer->next_mng = Carbon::now('America/Santiago');

                    } catch (\Exception $e) {
                        // echo $e;
                        echo $customer->cant;
                        exit();
                    }
                    $user_id = 2;
                    if ($customer->vendedor == 'Maria' || $customer->vendedor == 'Marìa')
                        $user_id = 3;
                    if ($customer->vendedor == 'Dayanna')
                        $user_id = 4;

                    switch (ucfirst(strtolower($customer->clasificacion_restaurant))) {
                        case 'Pizzeria' :
                            $id = 1;
                            break;
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
                    $management->description = $customer->seguimiento;
                    $management->created_at = new Carbon($dateFormated, 'America/Santiago');
                    $management->user_id = $user_id;

                    $newCustomer->save();
                    // DB::disableQueryLog();
                    $newCustomer->managements()->save($management);
                }

            });
        });

    }

}
