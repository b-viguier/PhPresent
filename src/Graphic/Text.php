<?php

namespace PhPresent\Graphic;

use PhPresent\Geometry;
use PhPresent\Pattern;

class Text implements Pattern\Identifiable
{
    /**
     * Use Drawer to create an instance.
     */
    protected function __construct(string $text, Font $font, Geometry\Rect $area, Geometry\Point $refPoint)
    {
        $this->text = $text;
        $this->font = $font;
        $this->area = $area;
        $this->refPoint = $refPoint;
    }

    public function movedTo(Geometry\Point $topLeft): self
    {
        $text = clone $this;
        $text->area = Geometry\Rect::fromTopLeftAndSize($topLeft, $this->area->size());
        $text->refPoint = Geometry\Point::fromCoordinates(
            $topLeft->x() - $this->area->topLeft()->x(),
            $topLeft->y() - $this->area->topLeft()->y()
        );

        return $text;
    }

    public function content(): string
    {
        return $this->text;
    }

    public function refPoint(): Geometry\Point
    {
        return $this->refPoint;
    }

    public function font(): Font
    {
        return $this->font;
    }

    public function area(): Geometry\Rect
    {
        return $this->area;
    }

    public function identifier(): Pattern\Identifier
    {
        return Pattern\Identifier::fromString(
            self::class,
            $this->text,
            $this->font->identifier(),
            $this->area->identifier(),
            $this->refPoint->identifier()
        );
    }

    /** @var string */
    private $text;
    /** @var Font */
    private $font;
    /** @var Geometry\Rect */
    private $area;
    /** @var Geometry\Point */
    private $refPoint;
}
