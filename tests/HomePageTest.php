<?php

namespace Tests;

class HomePageTest extends TestCase
{
    /**
     * A home page test.
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/');

        $this->assertResponseStatus(200);
    }
}
