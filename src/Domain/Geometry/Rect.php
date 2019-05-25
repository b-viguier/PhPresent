<?php

namespace RevealPhp\Domain\Geometry;

use RevealPhp\Domain\Pattern;

class Rect
{
    public static function fromOriginAndSize(Point $origin, Size $size): self
    {
        $rect = new self();
        $rect->origin = $origin;
        $rect->size = $size;

        return $rect;
    }

    public function topLeft(): Point
    {
        return $this->origin;
    }

    public function bottomRight(): Point
    {
        return Point::fromCoordinates(
            $this->origin->x() + $this->size->width(),
            $this->origin->y() + $this->size->height()
        );
    }

    use Pattern\PrivateConstructor;

    /** @var Point */
    private $origin;
    /** @var Size */
    private $size;
}
