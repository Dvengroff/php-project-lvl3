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
    public function testIndexPage()
    {
        $this->get('/');

        $this->assertResponseStatus(200);
    }

    public function testDomainPage()
    {
        $domain = factory(\App\Domain::class)->create();
        $this->get(route('domains.show', ['id' => $domain->id]));

        $this->assertResponseStatus(200);
    }

    public function testDomainStore()
    {
        $domain = factory(\App\Domain::class)->make();
        $this->post(route('domains.store'), ['url' => $domain->name]);

        $this->seeInDatabase('domains', ['name' => $domain->name]);
        $this->assertResponseStatus(302);
    }

    public function testDomainStoreFailed()
    {
        $url = "simple text";
        $this->post(route('domains.store'), ['url' => $url]);

        $this->assertResponseStatus(422);
    }
}
