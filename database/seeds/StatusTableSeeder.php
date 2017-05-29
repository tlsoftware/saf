<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $status = new Status();
        $status->name = 'Potencial Cliente';  // 1
        $status->save();


        $status = new Status();
        $status->name = 'Muestras';   // 2
        $status->save();

        $status = new Status();
        $status->name = 'Rechazos';  // 3
        $status->save();

        $status = new Status();
        $status->name = 'Cliente Activo';  //4
        $status->save();

        $status = new Status();
        $status->name = 'Bajas';   //5
        $status->save();

    }
}
