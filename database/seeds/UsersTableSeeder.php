<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      /*
      * Creacion de Usuario role Admin
      */
        $user = new User();
        $user->name = 'Ricardo Alzurutt';
        $user->email = 'ralzurutt@alman.cl';
        $user->password = '123123';
        $user->admin = 1;
        $user->save();

        /*
         * Creacion de Usuario role Vendedor
         */
        $user = new User();
        $user->name = 'Leonardo González';
        $user->email = 'leonardo@alman.cl';
        $user->password = '123123';
        $user->admin = 0;
        $user->save();

    }
}
