<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SM\Factory\Factory as SMFactory;

class Domain extends Model
{
    protected $fillable = [
        'name',
        'status',
        'content_length',
        'body',
        'h1',
        'keywords',
        'description'
    ];

    public function stateMachine()
    {
        $factory = new SMFactory(config('state-machine'));

        return $factory->get($this, 'domain_state_graph');
    }
}
