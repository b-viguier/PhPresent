<?php

namespace PhPresent\Geometry;

use PhPresent\Pattern;

class BoundingBox
{
    use Pattern\PrivateConstructor;

    public static function createEmpty(): self
    {
        $bbox = new self();
        $bbox->left = $bbox->top = PHP_FLOAT_MAX;
        $bbox->right = $bbox->bottom = -PHP_FLOAT_MAX;

        return $bbox;
    }

    public static function fromRect(Rect $rect): self
    {
        $topLeft = $rect->topLeft();
        $bottomRight = $rect->bottomRight();

        $bbox = new self();
        $bbox->top = $topLeft->y();
        $bbox->left = $topLeft->x();
        $bbox->bottom = $bottomRight->y();
        $bbox->right = $bottomRight->x();

        return $bbox;
    }

    public function merged(BoundingBox $bbox): self
    {
        $mergedBBox = new self();
        $mergedBBox->left = min($this->left, $bbox->left);
        $mergedBBox->right = max($this->right, $bbox->right);
        $mergedBBox->top = min($this->top, $bbox->top);
        $mergedBBox->bottom = max($this->bottom, $bbox->bottom);

        return $mergedBBox;
    }

    public function toRect(): Rect
    {
        return Rect::fromTopLeftAndSize(
            Point::fromCoordinates($this->left, $this->top),
            Size::fromDimensions($this->right - $this->left, $this->bottom - $this->top)
        );
    }

    /** @var float */
    private $left;
    /** @var float */
    private $right;
    /** @var float */
    private $top;
    /** @var float */
    private $bottom;
}
