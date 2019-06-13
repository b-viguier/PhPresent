<?php

namespace RevealPhp\Domain\Presentation\Slide;

use RevealPhp\Domain\Geometry;
use RevealPhp\Domain\Graphic;
use RevealPhp\Domain\Presentation;
use RevealPhp\Domain\Render;

class Rectangle implements Presentation\Slide
{
    public function __construct(Geometry\Rect $rect, Graphic\ImageFile $imageFile)
    {
        $this->rect = $rect;
        $this->imageFile = $imageFile;
    }

    public function render(Render\Drawer $drawer): string
    {
        return $drawer->image(
            $this->imageFile,
            null,
            $drawer->getArea()
        )->rectangle(
            $this->rect,
            Graphic\Brush::createDefault()
                ->withFillColor(Graphic\Color::RGB(255, 0, 0))
                ->withStrokeColor(Graphic\Color::RGB(0, 255, 0))
                ->withStrokeWidth(1)
        )->text(
            'Hello World',
            $this->rect->topLeft(),
            Graphic\Font::createDefault(),
            Graphic\Brush::createDefault()->withStrokeColor(Graphic\Color::white())
        )->getBmpData();
    }

    /** @var Geometry\Rect */
    private $rect;
    /** @var Graphic\ImageFile */
    private $imageFile;
}
