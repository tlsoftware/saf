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
        $status->name = 'Potencial Cliente';
        $status->save();

        $status = new Status();
        $status->name = 'Muestras';
        $status->save();

        $status = new Status();
        $status->name = 'Rechazos';
        $status->save();

        $status = new Status();
        $status->name = 'Cliente Activo';
        $status->save();

        $status = new Status();
        $status->name = 'Bajas';
        $status->save();
    }
}
