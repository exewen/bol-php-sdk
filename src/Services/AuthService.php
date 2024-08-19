<?php
declare(strict_types=1);

namespace Exewen\Bol\Services;

use Exewen\Config\Contract\ConfigInterface;
use Exewen\Http\Contract\HttpClientInterface;

class AuthService
{
    private $httpClient;
    private $driver;
    private $tokenUrl = '/token';

    public function __construct(HttpClientInterface $httpClient, ConfigInterface $config)
    {
        $this->httpClient = $httpClient;
        $this->driver     = $config->get('bol.channel_auth');
    }

    public function getToken(string $clientId, string $clientSecret): string
    {
        $params = [
            'grant_type' => 'client_credentials'
        ];
        $header = [
            'Authorization' => base64_encode("$clientId:$clientSecret"),
        ];
        return $this->httpClient->post($this->driver, $this->tokenUrl, $params, $header);
    }


}