<?php
declare(strict_types=1);

namespace Exewen\Bol\Contract;

interface BolInterface
{
    public function getToken(string $clientId, string $clientSecret);

    public function getOrders(array $params, array $header = []);

    public function getOrderDetail(string $orderId, array $params = [], array $header = []);

}