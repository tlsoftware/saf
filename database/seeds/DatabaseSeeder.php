<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        // $this->call(StatusTableSeeder::class);
        // $this->call(DetailsTableSeeder::class);
        $this->call(BstypesTableSeeder::class);
        // $this->call(CustomersTableSeeder::class);
    }
}
