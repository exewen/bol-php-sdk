<?php
declare(strict_types=1);

namespace Exewen\Bol;

use Exewen\Facades\Facade;
use Exewen\Http\HttpProvider;
use Exewen\Logger\LoggerProvider;
use Exewen\Bol\Contract\BolInterface;

/**
 * @method static void setAccessToken(string $accessToken)
 * @method static array getToken(string $clientId, string $clientSecret)
 * @method static array getOrders(array $params, array $header = [])
 * @method static array getOrderDetail(string $orderId, array $params=[], array $header = [])
 */
class BolFacade extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return BolInterface::class;
    }

    public static function getProviders(): array
    {
        return [
            LoggerProvider::class,
            HttpProvider::class,
            BolProvider::class
        ];
    }
}