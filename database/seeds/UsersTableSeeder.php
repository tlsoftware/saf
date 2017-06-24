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
        $user->role = 'admin';
        $user->save();
        /*
         * Creacion de Usuario role Vendedor
         */
        /*
        $user = new User();
        $user->name = 'Leonardo González';
        $user->email = 'leonardo@alman.cl';
        $user->password = '123123';
        $user->type = 0;
        $user->save();

        $user = new User();
        $user->name = 'María';
        $user->email = 'maria@alman.cl';
        $user->password = '123123';
        $user->profile = 2;
        $user->save();

        $user = new User();
        $user->name = 'Dayanna';
        $user->email = 'dayanna@alman.cl';
        $user->password = '123123';
        $user->profile = 1;
        $user->save();
    */
    }
}
