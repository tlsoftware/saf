<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CargaController extends Controller
{
    public function loadExcel()
    {
        $file = public_path() . '/excel/alman2.csv';

        Excel::load($file, function($reader) {

            $reader->take(2);

            foreach ($reader->get() as $customer) {
                echo 'Nombre Comercial: ' . $customer->bs_name . '<br>';
                echo 'Nombre de Fantasia: ' . $customer->name . '<br>';
            }
        });


    }

}
