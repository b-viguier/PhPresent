<?php

namespace PhPresent\Graphic\Exception;

class ColorException extends \DomainException
{
    public function __construct()
    {
        parent::__construct('Color components must be between 0 and 255.');
    }
}
