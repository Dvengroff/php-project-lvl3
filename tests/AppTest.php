<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AppTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A home page test.
     *
     * @return void
     */
    public function testHomePage()
    {
        $this->get('/');
        $this->assertResponseStatus(200);
    }
}
