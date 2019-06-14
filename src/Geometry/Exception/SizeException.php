<?php

namespace RevealPhp\Geometry\Exception;

class SizeException extends \DomainException
{
    public function __construct()
    {
        parent::__construct('Size components must be strictly greater than 0.');
    }
}
