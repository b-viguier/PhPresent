<?php

namespace RevealPhp\Presentation\Template\Simple;

use RevealPhp\Geometry;
use RevealPhp\Graphic;
use RevealPhp\Presentation;

class FullscreenColor implements Presentation\Slide
{
    public function __construct(Graphic\Color $color)
    {
        $this->color = $color;
    }

    public function render(Presentation\Timestamp $timestamp, Presentation\Screen $screen, Graphic\Drawer $drawer, Graphic\Theme $theme)
    {
        $bitmap = $drawer->drawRectangle(
            $screen->fullArea(),
            Graphic\Brush::createFilled($this->color)
        )->toBitmap($screen->fullArea()->size());

        return new Presentation\Frame(Presentation\Sprite::fromBitmap(
            $bitmap,
            Geometry\Point::origin()
        ));
    }

    /** @var Graphic\Color */
    private $color;
}
