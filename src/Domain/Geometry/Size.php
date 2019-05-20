<?php

namespace RevealPhp\Domain\Geometry;

use RevealPhp\Domain\Pattern;

class Size
{
    public static function fromDimensions(float $width, float $height): self
    {
        $instance = new self();
        $instance->width = $width;
        $instance->height = $height;

        return $instance;
    }

    public function width(): float
    {
        return $this->width;
    }

    public function height(): float
    {
        return $this->height;
    }

    use Pattern\PrivateConstructor;

    /** @var float */
    private $width = 0.0;
    /** @var float */
    private $height = 0.0;
}
