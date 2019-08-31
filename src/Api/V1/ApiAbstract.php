<?php

namespace Rumd3x\CloudCone\Api\V1;

use GuzzleHttp\Psr7\Request;
use Rumd3x\CloudCone\Api\V1Client;
use Rumd3x\CloudCone\Utils\AppHash;
use Rumd3x\CloudCone\Utils\AppSecret;

abstract class ApiAbstract
{
    const BASE_URL = "https://api.cloudcone.com/api/v1/";

    /**
     * Application Hash
     *
     * @var AppHash
     */
    private $appHash;

    /**
     * Application Secret Key (API Key)
     *
     * @var AppSecret
     */
    private $appSecret;

    /**
     * The CloudCone HTTP Client Wrapper
     *
     * @var Client
     */
    private $client;

    public function __construct(string $appSecret, string $appHash)
    {
        $this->appHash = new AppHash($appHash);
        $this->appSecret = new AppSecret($appSecret);
        $this->client = new Client($this->appSecret, $this->appHash, ['base_uri' => static::BASE_URL]);
    }

    protected function doGet(string $url)
    {
        $response = $this->client->get($url);
        return json_decode($response->getBody()->getContents(), true);
    }

    protected function doPost(string $url, array $data)
    {
        $response = $this->client->post($url, [
            'form_params' => $data,
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
