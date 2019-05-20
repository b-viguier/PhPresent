<?php

namespace RevealPhp\Domain\Geometry;

use RevealPhp\Domain\Pattern;

class Rect
{
    public static function fromOriginAndSize(Point $origin, Size $size): self
    {
        $instance = new self();
        $instance->origin = $origin;
        $instance->size = $size;

        return $instance;
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
