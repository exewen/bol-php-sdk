<?php
declare(strict_types=1);

namespace Exewen\Bol\Services;

use Exewen\Config\Contract\ConfigInterface;
use Exewen\Http\Contract\HttpClientInterface;

class ShippingsService
{
    private $httpClient;
    private $driver;
    private $setShipmentsUrl = '/retailer/shipments';
    private $setShipmentsStatusUrl = '/shared/process-status/{id}';

    public function __construct(HttpClientInterface $httpClient, ConfigInterface $config)
    {
        $this->httpClient = $httpClient;
        $this->driver     = $config->get('bol.channel_api');
    }


    public function setShipments(array $params, array $header)
    {
        $header['Content-Type'] = 'application/vnd.retailer.v10+json';
        return $this->httpClient->post($this->driver, $this->setShipmentsUrl, $params, $header);
    }

    public function getShipmentsStatus($id, array $header)
    {
        $uri    = str_replace('{id}', $id, $this->setShipmentsStatusUrl);
        return $this->httpClient->get($this->driver, $uri, [], $header);
    }

}