<?php

declare(strict_types=1);

namespace Exewen\Bol;

use Exewen\Bol\Constants\BolEnum;
use Exewen\Bol\Contract\BolInterface;
use Exewen\Bol\Middleware\AcceptMiddleware;
use Exewen\Bol\Middleware\AuthMiddleware;

class ConfigRegister
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                BolInterface::class => Bol::class,
            ],

            'bol' => [
                'channel_auth' => BolEnum::CHANNEL_AUTH,
                'channel_api'  => BolEnum::CHANNEL_API,
            ],

            'http' => [
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
                            AcceptMiddleware::class
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
                        'timeout'         => 20,
                        'handler'         => [
                            AcceptMiddleware::class,
                            AuthMiddleware::class,
                        ],
                        'extra'           => [],
                        'proxy'           => [
                            'switch' => false,
                            'http'   => '127.0.0.1:8888',
                            'https'  => '127.0.0.1:8888'
                        ]
                    ],
                ]
            ]


        ];
    }
}
