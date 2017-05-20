<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Management;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CargaController extends Controller
{

    public function loadExcel()
    {
        $file = public_path() . '/excel/base_de_datos_17052017.csv';

        Excel::load($file, function($reader) {

            $reader->take(2);

            foreach ($reader->get() as $customer) {

                $newCustomer = new Customer();
                $newCustomer->rut           = $customer->rut;
                $newCustomer->bs_name       = $customer->razon_social;
                $newCustomer->name          = $customer->nombre_fantasia;
                $newCustomer->phone1        = $customer->telefono_1;
                $newCustomer->phone2        = $customer->telefono_2;
                $newCustomer->phone3        = $customer->telefono_3;
                $newCustomer->contact_name  = $customer->nombre . ' ' .$customer->apellido;
                $newCustomer->position      = $customer->cargo;
                $newCustomer->email1        = $customer->correo;
                $newCustomer->email12       = $customer->correo_2;
                $newCustomer->email13       = $customer->correo_3;
                $newCustomer->web           = $customer->web;
                $newCustomer->status        = 0;

                $day = substr($customer->fecha_primer_contacto, 0, 2);
                $month = substr($customer->fecha_primer_contacto, 3, 2);
                $year = '20' . substr($customer->fecha_primer_contacto, 6, 4);
                $date = $year . '-' . $month .'-' . $day;
                $newCustomer->last_mng      = new Carbon($date, 'America/Santiago');
                $newCustomer->next_mng      = Carbon::now();

                $customer->user_id = 2;
                if ($customer->vendedor == 'Maria' || $customer->vendedor == 'Marìa')
                    $newCustomer->user_id = 3;
                if ($customer->vendedor == 'Dayanna')
                    $newCustomer->user_id = 4;

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

                $newCustomer->bstype_id     = $id;

                dd($newCustomer->toArray());

                // @todo Agregar eststus detallado y asociar al cliente recien creado

                $management = new Management();
                $management->description    = $customer->seguimiento;
                $management->st_details     = 0;
                $management->user_id        = 1;


                //echo 'Nombre Comercial: ' . $customer->bs_name . '<br>';
                //echo 'Nombre de Fantasia: ' . $customer->name . '<br>';
            }
        });


    }

}
