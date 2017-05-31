<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsersTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_users_list()
    {
        // Having Usuarios en la Base de Datos

        $this->visit('users')  // URL Existe
            ->see('User')      // Muestre el Resultado esperado
            ->see('Admin');
    }
}