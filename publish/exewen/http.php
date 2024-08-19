<?php

declare(strict_types=1);

use Exewen\Bol\Middleware\AcceptMiddleware;
use Exewen\Bol\Middleware\AuthMiddleware;
use Exewen\Http\Middleware\LogMiddleware;
use Exewen\Bol\Constants\BolEnum;

return [
    'channels' => [
        BolEnum::CHANNEL_AUTH => [
            'verify'          => false,
            'ssl'             => true,
            'host'            => 'login.bol.com',
            'port'            => null,
            'prefix'          => null,
            'connect_timeout' => 3,
            'timeout'         => 20,
            'handler'         => [
                AcceptMiddleware::class,
                LogMiddleware::class,
            ],
            'extra'           => [],
            'proxy'           => [
                'switch' => false,
                'http'   => '127.0.0.1:8888',
                'https'  => '127.0.0.1:8888'
            ]
        ],
        BolEnum::CHANNEL_API  => [
            'verify'          => false,
            'ssl'             => true,
            'host'            => 'api.bol.com',
            'port'            => null,
            'prefix'          => null,
            'connect_timeout' => 3,
            'timeout'         => 3,
            'handler'         => [
                AcceptMiddleware::class,
                AuthMiddleware::class,
                LogMiddleware::class,
            ],
            'extra'           => [],
            'proxy'           => [
                'switch' => false,
                'http'   => '127.0.0.1:9097',
                'https'  => '127.0.0.1:9097'
            ]
        ],
    ]
];