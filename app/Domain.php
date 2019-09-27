<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}