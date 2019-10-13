<?php

namespace PhPresent\Geometry;

use PhPresent\Pattern;

class Rect implements Pattern\Identifiable
{
    public static function fromTopLeftAndSize(Point $topLeft, Size $size): self
    {
        $rect = new self();
        $rect->topLeft = $topLeft;
        $rect->size = $size;

        return $rect;
    }

    public static function fromSize(Size $size): self
    {
        $rect = new self();
        $rect->topLeft = Point::origin();
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
        $rect->topLeft = Point::fromCoordinates($xMin, $yMin);
        $rect->size = Size::fromDimensions($xMax - $xMin, $yMax - $yMin);

        return $rect;
    }

    public function identifier(): Pattern\Identifier
    {
        return Pattern\Identifier::fromString(
            self::class,
            $this->topLeft->identifier(),
            $this->size->identifier()
        );
    }

    public function insideRect(float $ratio): self
    {
        $rect = new self();
        if ($ratio > $this->size->ratio()) {
            $rect->size = Size::fromDimensions(
                $this->size->width(),
                $this->size->width() / $ratio
            );
            $rect->topLeft = Point::fromCoordinates(
                $this->topLeft->x(),
                $this->topLeft->y() + ($this->size->height() - $rect->size->height()) / 2
            );
        } else {
            $rect->size = Size::fromDimensions(
                $this->size->height() * $ratio,
                $this->size->height()
            );
            $rect->topLeft = Point::fromCoordinates(
                $this->topLeft->x() + ($this->size->width() - $rect->size->width()) / 2,
                $this->topLeft->y()
            );
        }

        return $rect;
    }

    public function outsideRect(float $ratio): self
    {
        $rect = new self();
        if ($ratio < $this->size->ratio()) {
            $rect->size = Size::fromDimensions(
                $this->size->width(),
                $this->size->width() / $ratio
            );
            $rect->topLeft = Point::fromCoordinates(
                $this->topLeft->x(),
                $this->topLeft->y() + ($this->size->height() - $rect->size->height()) / 2
            );
        } else {
            $rect->size = Size::fromDimensions(
                $this->size->height() * $ratio,
                $this->size->height()
            );
            $rect->topLeft = Point::fromCoordinates(
                $this->topLeft->x() + ($this->size->width() - $rect->size->width()) / 2,
                $this->topLeft->y()
            );
        }

        return $rect;
    }

    public function topLeft(): Point
    {
        return $this->topLeft;
    }

    public function bottomRight(): Point
    {
        return Point::fromCoordinates(
            $this->topLeft->x() + $this->size->width(),
            $this->topLeft->y() + $this->size->height()
        );
    }

    public function size(): Size
    {
        return $this->size;
    }

    public function center(): Point
    {
        return Point::fromCoordinates(
            $this->topLeft->x() + $this->size->width() / 2,
            $this->topLeft->y() + $this->size->height() / 2
        );
    }

    public function movedBy(Vector $vector): self
    {
        $rect = clone $this;
        $rect->topLeft = $this->topLeft->movedBy($vector);

        return $rect;
    }

    /**
     * Scale from center
     */
    public function scaledBy(float $scale): self
    {
        $rect = clone $this;
        $rect->size = $this->size->scaledBy($scale);
        $rect->topLeft = $this->topLeft->movedBy(
            Vector::fromPoints(
                $this->topLeft,
                $this->center()
            )->scaledBy($scale)
        );

        return $rect;
    }

    public function leftAlignedWith(Point $point): self
    {
        $rect = clone $this;
        $rect->topLeft = Point::fromCoordinates($point->x(), $this->topLeft->y());

        return $rect;
    }

    public function rightAlignedWith(Point $point): self
    {
        $rect = clone $this;
        $rect->topLeft = Point::fromCoordinates($point->x() - $this->size->width(), $this->topLeft->y());

        return $rect;
    }

    public function hCenteredWith(Point $point): self
    {
        $rect = clone $this;
        $rect->topLeft = Point::fromCoordinates($point->x() - $this->size->width() / 2, $this->topLeft->y());

        return $rect;
    }

    public function topAlignedWith(Point $point): self
    {
        $rect = clone $this;
        $rect->topLeft = Point::fromCoordinates($this->topLeft->x(), $point->y());

        return $rect;
    }

    public function bottomAlignedWith(Point $point): self
    {
        $rect = clone $this;
        $rect->topLeft = Point::fromCoordinates($this->topLeft->x(), $point->y() - $this->size->height());

        return $rect;
    }

    public function vCenteredWith(Point $point): self
    {
        $rect = clone $this;
        $rect->topLeft = Point::fromCoordinates($this->topLeft->x(), $point->y() - $this->size->height() / 2);

        return $rect;
    }

    public function centeredOn(Point $point): self
    {
        return $this->movedBy(Vector::fromPoints($this->center(), $point));
    }

    use Pattern\PrivateConstructor;

    /** @var Point */
    private $topLeft;
    /** @var Size */
    private $size;
}
