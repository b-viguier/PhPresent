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

    public static function fromSize(Size $size): self
    {
        $rect = new self();
        $rect->origin = Point::origin();
        $rect->size = $size;

        return $rect;
    }

    public static function fromOppositeCorners(Point $corner1, Point $corner2): self
    {
        if ($corner1->x() > $corner2->x()) {
            $xMin = $corner2->x();
            $xMax = $corner1->x();
        } else {
            $xMin = $corner1->x();
            $xMax = $corner2->x();
        }

        if ($corner1->y() > $corner2->y()) {
            $yMin = $corner2->y();
            $yMax = $corner1->y();
        } else {
            $yMin = $corner1->y();
            $yMax = $corner2->y();
        }

        $rect = new self();
        $rect->origin = Point::fromCoordinates($xMin, $yMin);
        $rect->size = Size::fromDimensions($xMax - $xMin, $yMax - $yMin);

        return $rect;
    }

    public static function bounding(Rect $box1, Rect $box2): self
    {
        $xMin = min($box1->topLeft()->x(), $box2->topLeft()->x());
        $yMin = min($box1->topLeft()->y(), $box2->topLeft()->y());
        $bottomRight1 = $box1->bottomRight();
        $bottomRight2 = $box2->bottomRight();
        $xMax = max($bottomRight1->x(), $bottomRight2->x());
        $yMax = max($bottomRight1->y(), $bottomRight2->y());

        $rect = new self();
        $rect->origin = Point::fromCoordinates($xMin, $yMin);
        $rect->size = Size::fromDimensions($xMax - $xMin, $yMax - $yMin);

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

    public function center(): Point
    {
        return Point::fromCoordinates(
            $this->origin->x() + $this->size->width() / 2,
            $this->origin->y() + $this->size->height() / 2
        );
    }

    use Pattern\PrivateConstructor;

    /** @var Point */
    private $origin;
    /** @var Size */
    private $size;
}
