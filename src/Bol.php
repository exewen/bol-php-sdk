<?php

declare(strict_types=1);

namespace Exewen\Bol;

use Exewen\Bol\Constants\BolEnum;
use Exewen\Bol\Contract\BolInterface;
use Exewen\Bol\Exception\BolException;
use Exewen\Bol\Services\AuthService;
use Exewen\Bol\Services\OrdersService;
use Exewen\Bol\Services\ShippingsService;
use Exewen\Config\Contract\ConfigInterface;

class Bol implements BolInterface
{
    private $config;
    private $authService;
    private $ordersService;
    /**
     * @var ShippingsService
     */
    private $shippingsService;

    public function __construct(
        ConfigInterface  $config,
        AuthService      $authService,
        OrdersService    $ordersService,
        ShippingsService $shippingsService
    )
    {
        $this->config           = $config;
        $this->authService      = $authService;
        $this->ordersService    = $ordersService;
        $this->shippingsService = $shippingsService;
    }

    public function setAccessToken(string $accessToken, string $channel = BolEnum::CHANNEL_API)
    {
        $this->config->set('http.channels.' . $channel . '.extra.access_token', $accessToken);
    }

    public function getToken(string $clientId, string $clientSecret)
    {
        $result = json_decode($this->authService->getToken($clientId, $clientSecret), true);
        if (!isset($result['access_token'])) {
            throw new BolException('Bol:获取token异常');
        }
        return $result;
    }

    public function getOrders(array $params, array $header = [])
    {
        return json_decode($this->ordersService->getOrders($params, $header), true);
    }

    public function getOrderDetail(string $orderId, array $params = [], array $header = [])
    {
        return json_decode($this->ordersService->getOrderDetail($orderId, $params, $header), true);
    }

    public function setShipments(array $params = [], array $header = [])
    {
        return json_decode($this->shippingsService->setShipments($params, $header), true);
    }

    public function getShipmentsStatus($id, array $header = [])
    {
        return json_decode($this->shippingsService->getShipmentsStatus($id, $header), true);
    }

}
