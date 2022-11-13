<?php

return [

    'defaults' => [
        'guard' => 'api',
        'passwords' => 'users',
    ],

    'guards' => [
        'api' => [
            'driver' => 'jwt',
            'provider' => 'users',
        ],

        'admin' => [
            'driver' => 'jwt',
            'provider' => 'admins',
        ],
        // 'companies' => [
        //     'driver' => 'jwt',
        //     'provider' => 'companies',
        // ],
    ],


    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Admin::class,
        ],
        // 'companies' => [
        //     'driver' => 'eloquent',
        //     'model' => App\Company::class,
        // ],
    ],


    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 180,
            'throttle' => 180,
        ],
        // 'companies' => [
        //     'provider' => 'companies',
        //     'table' => 'password_resets',
        //     'expire' => 180,
        //     'throttle' => 180,
        // ],
    ],

    'password_timeout' => 10800,

];
