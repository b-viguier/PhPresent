<?php

namespace RevealPhp\Geometry;

use RevealPhp\Pattern;

class Point implements Pattern\Identifiable
{
    public static function origin(): self
    {
        $point = new self();
        $point->x = 0;
        $point->y = 0;

        return $point;
    }

    public static function fromCoordinates(float $x, float $y): self
    {
        $point = new self();
        $point->x = $x;
        $point->y = $y;

        return $point;
    }

    public function x(): float
    {
        return $this->x;
    }

    public function y(): float
    {
        return $this->y;
    }

    public function movedBy(Vector $vector): self
    {
        $point = clone $this;
        $point->x = $this->x + $vector->dx();
        $point->y = $this->y + $vector->dy();

        return $point;
    }

    public function identifier(): Pattern\Identifier
    {
        return Pattern\Identifier::fromString(
            self::class,
            $this->x,
            $this->y
        );
    }

    use Pattern\PrivateConstructor;

    /** @var float */
    private $x = 0.0;
    /** @var float */
    private $y = 0.0;
}
