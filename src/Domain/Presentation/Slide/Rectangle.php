<?php

namespace RevealPhp\Domain\Presentation\Slide;

use RevealPhp\Domain\Geometry;
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
        return $drawer->rectangle($this->rect)->getBmpData();
    }

    /** @var Geometry\Rect */
    private $rect;
}
