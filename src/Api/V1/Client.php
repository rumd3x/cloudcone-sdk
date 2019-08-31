<?php

namespace Rumd3x\CloudCone\Api\V1;

use GuzzleHttp\ClientInterface;
use Rumd3x\CloudCone\Utils\AppHash;
use Rumd3x\CloudCone\Utils\AppSecret;
use GuzzleHttp\Client as GuzzleHttpClient;

class Client extends GuzzleHttpClient implements ClientInterface
{
    /**
     * Creates a new CloudCone Client
     *
     * @param string $appSecret
     * @param string $appHash
     * @param array $config
     */
    public function __construct(AppSecret $appSecret, AppHash $appHash, array $config = [])
    {
        $cloudConeConfigs = [
            'headers' => [
                'Hash' => $appHash->getValue(),
                'App-Secret' => $appSecret->getValue(),
            ],
        ];

        parent::__construct(array_merge($cloudConeConfigs, $config));
    }
}
