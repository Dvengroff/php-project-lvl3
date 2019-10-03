<?php

use App\Domain;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get(
    '/',
    ['as' => 'index', function () use ($router) {
        $url = route('index');
        Log::info("Boot {$url} page");
        return view('index');
    }]
);

$router->get(
    '/domains',
    ['as' => 'domains.index', 'uses' => 'DomainController@index']
);

$router->post(
    '/domains',
    ['as' => 'domains.store', 'uses' => 'DomainController@store']
);

$router->get(
    '/domains/{id}',
    ['as' => 'domains.show', 'uses' => 'DomainController@show']
);
