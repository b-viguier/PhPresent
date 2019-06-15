<?php

namespace RevealPhp\Presentation\Template\Simple;

use RevealPhp\Graphic;
use RevealPhp\Presentation;

class FullscreenColor implements Presentation\Slide
{
    public function __construct(Graphic\Color $color)
    {
        $this->color = $color;
    }

    public function render(Graphic\Drawer $drawer, Graphic\Theme $theme): string
    {
        return $drawer->rectangle(
            $drawer->getArea(),
            $theme->brush()
                ->withFillColor($this->color)
                ->withStrokeColor($this->color)
        )->getBmpData();
    }

    /** @var Graphic\Color */
    private $color;
}
