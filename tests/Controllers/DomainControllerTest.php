<?php

namespace Tests\Controllers;

use Tests\TestCase;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class DomainControllerTest extends TestCase
{
    use DatabaseMigrations;
    
    public function testIndex()
    {
        $domains = factory(\App\Domain::class, 15)->create();
        $this->get(route('domains.index'));

        $this->assertResponseStatus(200);
    }
    
    public function testShow()
    {
        $domain = factory(\App\Domain::class)->create();
        $this->get(route('domains.show', ['id' => $domain->id]));

        $this->assertResponseStatus(200);
    }

    public function testStoreCompleted()
    {
        $body = file_get_contents(__DIR__ . "/../fixtures/test.html");
        $mock = new MockHandler(
            [
                new Response(200, ['Content-Length' => mb_strlen($body)], $body)
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

        $this->assertResponseStatus(302);
        $this->seeInDatabase(
            'domains',
            [
                'name' => $domain->name,
                'state' => 'completed',
                'status' => 200,
                'content_length' => mb_strlen($body),
                'body' => $body,
                'h1' => "Тестовый заголовок",
                'keywords' => "php, project, hexlet, test",
                'description' => "тестовая html-страница к 3-му проекту Хекслета"
            ]
        );
    }

    public function testStoreFailed()
    {
        $url = "http://abc.def";
        $this->post(route('domains.store'), ['url' => $url]);

        $this->assertResponseStatus(302);
        $this->seeInDatabase(
            'domains',
            [
                'name' => $url,
                'state' => 'failed',
                'status' => null,
                'content_length' => null,
                'body' => null,
                'h1' => null,
                'keywords' => null,
                'description' => null
            ]
        );
    }

    public function testStoreWithInvalidInputs()
    {
        $url = "simple text";
        $this->post(route('domains.store'), ['url' => $url]);

        $this->assertResponseStatus(422);
    }
}
