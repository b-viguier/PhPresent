<?php

namespace PhPresent\Geometry;

use PhPresent\Pattern;

class Vector
{
    public static function fromCoordinates(float $dx, float $dy): self
    {
        $vector = new self();
        $vector->dx = $dx;
        $vector->dy = $dy;

        return $vector;
    }

    public static function fromPoints(Point $src, Point $dst): self
    {
        $vector = new self();
        $vector->dx = $dst->x() - $src->x();
        $vector->dy = $dst->y() - $src->y();

        return $vector;
    }

    public function dx(): float
    {
        return $this->dx;
    }

    public function dy(): float
    {
        return $this->dy;
    }

    public function scaledBy(float $scale): self
    {
        $vector = clone $this;
        $vector->dx = $this->dx * $scale;
        $vector->dy = $this->dy * $scale;

        return $vector;
    }

    public function addedTo(Vector $other): self
    {
        $vector = clone $this;
        $vector->dx = $this->dx + $other->dx;
        $vector->dy = $this->dy + $other->dy;

        return $vector;
    }

    use Pattern\PrivateConstructor;

    /** @var float */
    private $dx;
    /** @var float */
    private $dy;
}
