<?php

namespace RevealPhp\Presentation\Slide;

use RevealPhp\Geometry;
use RevealPhp\Graphic;
use RevealPhp\Presentation;
use RevealPhp\Render;

class Rectangle implements Presentation\Slide
{
    public function __construct(Geometry\Rect $rect, Graphic\ImageFile $imageFile)
    {
        $this->rect = $rect;
        $this->imageFile = $imageFile;
    }

    public function render(Graphic\Drawer $drawer, Graphic\Theme $theme): string
    {
        return $drawer->image(
            $this->imageFile,
            null,
            $drawer->getArea()
        )->rectangle(
            $this->rect,
            $theme->brush()
        )->text(
            'Hello World',
            $this->rect->topLeft(),
            $theme->font(),
            $theme->brush()
        )->getBmpData();
    }

    /** @var Geometry\Rect */
    private $rect;
    /** @var Graphic\ImageFile */
    private $imageFile;
}
