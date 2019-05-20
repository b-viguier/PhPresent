<?php

namespace RevealPhp\Domain\Geometry;

use RevealPhp\Domain\Pattern;

class Point
{
    public static function fromCoordinates(float $x, float $y): self
    {
        $instance = new self();
        $instance->x = $x;
        $instance->y = $y;

        return $instance;
    }

    public function x(): float
    {
        return $this->x;
    }

    public function y(): float
    {
        return $this->y;
    }

    use Pattern\PrivateConstructor;

    /** @var float */
    private $x = 0.0;
    /** @var float */
    private $y = 0.0;
}
