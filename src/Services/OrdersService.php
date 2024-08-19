<?php
declare(strict_types=1);

namespace Exewen\Bol\Services;

use Exewen\Config\Contract\ConfigInterface;
use Exewen\Http\Contract\HttpClientInterface;

class OrdersService
{
    private $httpClient;
    private $driver;
    private $ordersListUrl = '/retailer/orders';
    private $ordersDetailUrl = '/retailer/orders/{orderId}';

    public function __construct(HttpClientInterface $httpClient, ConfigInterface $config)
    {
        $this->httpClient = $httpClient;
        $this->driver     = $config->get('bol.channel_api');
    }

    public function getOrders(array $params, array $header): string
    {
        return $this->httpClient->get($this->driver, $this->ordersListUrl, $params, $header);
    }

    public function getOrderDetail(string $orderId, array $params, array $header): string
    {
        $url    = str_replace('{orderId}', $orderId, $this->ordersDetailUrl);
        return $this->httpClient->get($this->driver, $url, $params, $header);
    }


}