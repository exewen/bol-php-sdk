<?php
declare(strict_types=1);

namespace ExewenTest\Bol;

use Exewen\Bol\BolFacade;

class BolTest extends Base
{

    /**
     * 测试订单信息
     * @return void
     */
    public function testToken()
    {
        $clientId     = getenv('BOL_CLIENT_ID');
        $clientSecret = getenv('BOL_CLIENT_SECRET');
        $response     = BolFacade::getToken($clientId, $clientSecret);
        $this->assertNotEmpty($response);
    }

    public function testOrders()
    {
        BolFacade::setAccessToken(getenv('BOL_ACCESS_TOKEN'));
        $params = [
            'fulfilment-method'  => "ALL",
            'status'             => "ALL",
            'latest-change-date' => "2024-08-18",
            'page'               => 1,
        ];
        $response = BolFacade::getOrders($params);
        $this->assertNotEmpty($response);
    }

    public function testOrderDetail()
    {
        BolFacade::setAccessToken(getenv('BOL_ACCESS_TOKEN'));

        $orderId   = '4152692732';
        $response = BolFacade::getOrderDetail($orderId);
        $this->assertNotEmpty($response);
    }

}