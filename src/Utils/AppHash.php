<?php

namespace Rumd3x\CloudCone\Utils;

use Rumd3x\CloudCone\Exceptions\ConstructorException;

class AppHash
{
    /**
     * Application Hash
     *
     * @var string
     */
    private $appHash;

    public function __construct(string $appHash)
    {
        $appHash = trim($appHash);

        if (!ctype_alnum($appHash) || strlen($appHash) !== 41) {
            throw new ConstructorException(static::class, func_get_args());
        }

        $this->appHash = $appHash;
    }

    public function getValue()
    {
        return (string) $this->appHash;
    }

    public function __toString()
    {
        return $this->getValue();
    }
}
