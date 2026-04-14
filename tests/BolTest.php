<?php
declare(strict_types=1);

namespace ExewenTest\Bol;

use Exewen\Bol\BolFacade;

class BolTest extends Base
{

//    /**
//     * 测试订单信息
//     * @return void
//     */
//    public function testToken()
//    {
//        $clientId     = getenv('BOL_CLIENT_ID');
//        $clientSecret = getenv('BOL_CLIENT_SECRET');
//        $response     = BolFacade::getToken($clientId, $clientSecret);
//        $this->assertNotEmpty($response);
//    }

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

    public function testOffers()
    {
        BolFacade::setAccessToken(getenv('BOL_ACCESS_TOKEN'));
        $params = [
            'page'               => 1,
        ];
        $response = BolFacade::getOffers($params);
        $this->assertNotEmpty($response);
    }

    public function testCreateOffer()
    {
        BolFacade::setAccessToken(getenv('BOL_ACCESS_TOKEN'));
        $data = [
            'ean' => '1234567890123',
            'condition' => 'NEW',
            'price' => 19.99,
            'stock' => 10
        ];
        $response = BolFacade::createOffer($data);
        $this->assertNotEmpty($response);
    }

    public function testUpdateOffer()
    {
        BolFacade::setAccessToken(getenv('BOL_ACCESS_TOKEN'));
        $offerId = 'OFFER_ID'; // 替换为实际的offer ID
        $data = [
            'price' => 17.99,
            'stock' => 15
        ];
        $response = BolFacade::updateOffer($offerId, $data);
        $this->assertNotEmpty($response);
    }

    public function testCatalogProduct()
    {
        BolFacade::setAccessToken(getenv('BOL_ACCESS_TOKEN'));
        $ean = '8712345678901'; // 替换为实际的EAN码
        $response = BolFacade::getCatalogProduct($ean);
        $this->assertNotEmpty($response);
    }

}