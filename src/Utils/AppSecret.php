<?php

namespace Rumd3x\CloudCone\Utils;

use Rumd3x\CloudCone\Exceptions\ConstructorException;

class AppSecret
{
    /**
     * Application Secret Key (API Key)
     *
     * @var string
     */
    private $appSecret;

    public function __construct(string $appSecret)
    {
        $appSecret = trim($appSecret);

        if (!ctype_alnum($appSecret) || strlen($appSecret) !== 16) {
            throw new ConstructorException(static::class, func_get_args());
        }

        $this->appSecret = $appSecret;
    }

    public function getValue()
    {
        return (string) $this->appSecret;
    }

    public function __toString()
    {
        return $this->getValue();
    }
}
