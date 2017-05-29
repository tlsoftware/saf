<?php

use Illuminate\Database\Seeder;
use App\Detail;

class DetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //   Potencial Cliente  = 1

        $detail = new Detail();
        $detail->name = 'En Gestion';
        $detail->status_id = 1;
        $detail->save();

        $detail = new Detail();
        $detail->name = 'Positivo con Correo';
        $detail->status_id = 1;
        $detail->save();

        $detail = new Detail();
        $detail->name = 'Positivo sin Correo';
        $detail->status_id = 1;
        $detail->save();

        $detail = new Detail();
        $detail->name = 'No Contesta';
        $detail->status_id = 1;
        $detail->save();

        $detail = new Detail();
        $detail->name = 'Envio Catalogo';
        $detail->status_id = 1;
        $detail->save();

        $detail = new Detail();
        $detail->name = 'Solicitud de Muestras';
        $detail->status_id = 1;
        $detail->save();


       //     Muestras = 2


        $detail = new Detail();
        $detail->name = 'Sin Contactar';
        $detail->status_id = 2;
        $detail->save();

        $detail = new Detail();
        $detail->name = 'Por Concretar Venta';
        $detail->status_id = 2;
        $detail->save();

        $detail = new Detail();
        $detail->name = 'En Seguimiento';
        $detail->status_id = 2;
        $detail->save();

        $detail = new Detail();
        $detail->name = 'Venta';
        $detail->status_id = 2;
        $detail->save();

        $detail = new Detail();
        $detail->name = 'Rechazado';
        $detail->status_id = 2;
        $detail->save();


        //      Rechazos = 3


        $detail = new Detail();
        $detail->name = 'Usan Tomates Naturales';
        $detail->status_id = 3;
        $detail->save();

        $detail = new Detail();
        $detail->name = 'Precio';
        $detail->status_id = 3;
        $detail->save();

        $detail = new Detail();
        $detail->name = 'Usan Salsa para Pizza';
        $detail->status_id = 3;
        $detail->save();

        $detail = new Detail();
        $detail->name = 'Usan Concentrado';
        $detail->status_id = 3;
        $detail->save();

        $detail = new Detail();
        $detail->name = 'Usan otro Producto';
        $detail->status_id = 3;
        $detail->save();

        $detail = new Detail();
        $detail->name = 'Presetacion';
        $detail->status_id = 3;
        $detail->save();


        //       Clientes Activos = 4


        $detail = new Detail();
        $detail->name = 'En Gestion';
        $detail->status_id = 4;
        $detail->save();

        $detail = new Detail();
        $detail->name = 'Baja';
        $detail->status_id = 4;
        $detail->save();

        $detail = new Detail();
        $detail->name = 'Promesa de Compra';
        $detail->status_id = 4;
        $detail->save();

        $detail = new Detail();
        $detail->name = 'Venta';
        $detail->status_id = 4;
        $detail->save();


       //      Bajas = 5


        $detail = new Detail();
        $detail->name = 'Precio';
        $detail->status_id = 5;
        $detail->save();

        $detail = new Detail();
        $detail->name = 'Motivos Administrativos';
        $detail->status_id = 5;
        $detail->save();

        $detail = new Detail();
        $detail->name = 'Falta de Seguimiento';
        $detail->status_id = 5;
        $detail->save();

        $detail = new Detail();
        $detail->name = 'Calidad del Producto';
        $detail->status_id = 5;
        $detail->save();

        $detail = new Detail();
        $detail->name = 'Otros';
        $detail->status_id = 5;
        $detail->save();

    }
}
