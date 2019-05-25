<?php

namespace RevealPhp\Domain\Presentation\Slide;

use RevealPhp\Domain\Geometry;
use RevealPhp\Domain\Graphic;
use RevealPhp\Domain\Presentation;
use RevealPhp\Domain\Render;

class Rectangle implements Presentation\Slide
{
    public function __construct(Geometry\Rect $rect)
    {
        $this->rect = $rect;
    }

    public function render(Render\Drawer $drawer): string
    {
        return $drawer->rectangle(
            $this->rect,
            Graphic\ShapeBrush::createDefault()
                ->withFillColor(Graphic\Color::RGB(255, 0, 0))
                ->withStrokeColor(Graphic\Color::RGB(0, 255, 0))
                ->withStrokeWidth(4)
        )->getBmpData();
    }

    /** @var Geometry\Rect */
    private $rect;
}
