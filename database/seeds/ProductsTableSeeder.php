<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new Product();
        $product->code = 'PT690';
        $product->name = 'Passata di Pomodoro LA CARANTA 720ml';
        $product->save();

        $product = new Product();
        $product->code = 'TCH400';
        $product->name = 'Tomates Cherry LA CARANTA 400g';
        $product->save();

        $product = new Product();
        $product->code = 'TP2550';
        $product->name = 'Tomates Pelados Enteros LA CARANTA 2550g';
        $product->save();

        $product = new Product();
        $product->code = 'TP400';
        $product->name = 'Tomates Pelados Enteros LA CARANTA 400g';
        $product->save();

        $product = new Product();
        $product->code = 'TP800';
        $product->name = 'Tomates Pelados Enteros LA CARANTA 800g';
        $product->save();

        $product = new Product();
        $product->code = 'TTP2550';
        $product->name = 'Tomates en Trozos LA CARANTA 2550g';
        $product->save();

        $product = new Product();
        $product->code = 'TTP400';
        $product->name = 'Tomates en Trozos LA CARANTA 400g';
        $product->save();

        $product = new Product();
        $product->code = 'TTP800';
        $product->name = 'Tomates en Trozos LA CARANTA 800g';
        $product->save();

    }
}