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
        $bstype->type = 'Itaiana';
        $bstype->save();
    }
}
