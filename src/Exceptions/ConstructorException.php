<?php

namespace Rumd3x\CloudCone\Exceptions;

use Exception;

class ConstructorException extends Exception
{
    public function __construct(string $class, array $args)
    {
        parent::__construct(sprintf("Failed to construct class %s, one or more arguments were invalid: %s", $class, implode(", ", $args)));
    }
}
