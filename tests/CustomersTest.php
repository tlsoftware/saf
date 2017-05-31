<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CustomersTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->visit('/admin/index')  // URL Existe

        ->see('Kertzmann-Moen')      // Muestre el Resultado esperado
        ->see('Ziemann, Runolfsson and Gusikowski')
            ->see('Deckow-Fadel')
        ->see('Moen LLC')
        ->see('Reichert-Swaniawski')
        ->see('Greenholt, Jacobs and Grimes')
        ->see('Runolfsdottir-Paucek')
        ->see('Ziemann, Heidenreich and Morar')
        ->see('Kuphal and Sons')
        ->see('Cormier-Kirlin')
        ->see('Homenick-Reilly');
    }
}
