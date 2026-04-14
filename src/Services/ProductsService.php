<?php
declare(strict_types=1);

namespace Exewen\Bol\Services;

use Exewen\Config\Contract\ConfigInterface;
use Exewen\Http\Contract\HttpClientInterface;

class ProductsService
{
    private $httpClient;
    private $driver;
    private $catalogProductUrl = '/retailer/content/catalog-products/{ean}';

    public function __construct(HttpClientInterface $httpClient, ConfigInterface $config)
    {
        $this->httpClient = $httpClient;
        $this->driver     = $config->get('bol.channel_api');
    }

    public function getCatalogProduct(string $ean, array $header = []): string
    {
        $url = str_replace('{ean}', $ean, $this->catalogProductUrl);
        $response = $this->httpClient->get($this->driver, $url, [], $header);
        return $response->getBody()->getContents();
    }
}
