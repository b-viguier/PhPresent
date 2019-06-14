<?php

namespace RevealPhp\Geometry;

use RevealPhp\Pattern;

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

    public function size(): Size
    {
        return $this->size;
    }

    use Pattern\PrivateConstructor;

    /** @var Point */
    private $origin;
    /** @var Size */
    private $size;
}
