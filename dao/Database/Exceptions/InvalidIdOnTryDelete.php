<?php

namespace DAO\Database\Exceptions;

use InvalidArgumentException;

class InvalidIdOnTryDelete extends InvalidArgumentException
{
    public function __construct($code = 0, $previous = null)
    {
        parent::__construct('Failed on try delete by id, id must be string|int.', $code, $previous);
    }
}