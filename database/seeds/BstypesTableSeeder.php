<?php

use Illuminate\Database\Seeder;
use App\Bstype;

class BstypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bstype = new Bstype();
        $bstype->type = 'Pizzeria';
        $bstype->save();

        $bstype = new Bstype();
        $bstype->type = 'Italiana';
        $bstype->save();

        $bstype = new Bstype();
        $bstype->type = 'Bar';
        $bstype->save();

        $bstype = new Bstype();
        $bstype->type = 'Bazar';
        $bstype->save();

        $bstype = new Bstype();
        $bstype->type = 'Cafe';
        $bstype->save();

        $bstype = new Bstype();
        $bstype->type = 'Carnes';
        $bstype->save();

        $bstype = new Bstype();
        $bstype->type = 'Casino';
        $bstype->save();

        $bstype = new Bstype();
        $bstype->type = 'Cerveceria';
        $bstype->save();

        $bstype = new Bstype();
        $bstype->type = 'Comida';
        $bstype->save();

        $bstype = new Bstype();
        $bstype->type = 'Comidas';
        $bstype->save();

        $bstype = new Bstype();
        $bstype->type = 'Distribuidora';
        $bstype->save();

        $bstype = new Bstype();
        $bstype->type = 'Empanadas';
        $bstype->save();

        $bstype = new Bstype();
        $bstype->type = 'Fabrica';
        $bstype->save();

        $bstype = new Bstype();
        $bstype->type = 'Hotel';
        $bstype->save();

        $bstype = new Bstype();
        $bstype->type = 'Pastas';
        $bstype->save();

        $bstype = new Bstype();
        $bstype->type = 'Restaurant';
        $bstype->save();

        $bstype = new Bstype();
        $bstype->type = 'Varios';
        $bstype->save();

        $bstype = new Bstype();
        $bstype->type = 'Vegetariano';
        $bstype->save();
    }
}
