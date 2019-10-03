<?php

return [
    'domain_state_graph' => [
        'class' => App\Domain::class,

        'property_path' => 'state',

        'states' => [
            'init',
            'completed',
            'failed'
        ],

        'transitions' => [
            'complete' => [
                'from' => ['init'],
                'to' => 'completed',
            ],
            'fail' => [
                'from' => ['init'],
                'to' => 'failed',
            ]
        ],
    ],
];
