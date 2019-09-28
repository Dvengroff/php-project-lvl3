<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

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
        $body = file_get_contents(__DIR__ . "/fixtures/test.html");
        $mock = new MockHandler(
            [
                new Response(200, ['Content-Length' => 5], $body)
            ]
        );
        $handler = HandlerStack::create($mock);
        $this->app->bind(
            'HttpClient',
            function ($app) use ($handler) {
                return new Client(['handler' => $handler]);
            }
        );
        
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

    public function testDomainsPage()
    {
        $domains = factory(\App\Domain::class, 15)->create();
        $this->get(route('domains.index'));

        $this->assertResponseStatus(200);
    }
}
