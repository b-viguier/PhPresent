<?php

namespace PhPresent\Presentation\Template\Simple;

use PhPresent\Geometry;
use PhPresent\Graphic;
use PhPresent\Presentation;

class FullscreenColor implements Presentation\Slide
{
    public function __construct(Graphic\Color $color)
    {
        $this->color = $color;
    }

    public function render(Presentation\Timestamp $timestamp, Presentation\Screen $screen, Graphic\Drawer $drawer, Graphic\Theme $theme)
    {
        $bitmap = $drawer->drawRectangle(
            Geometry\Rect::fromSize($onePixelSize = Geometry\Size::fromDimensions(1, 1)),
            Graphic\Brush::createFilled($this->color)
        )->toBitmap($onePixelSize);

        return new Presentation\Frame(Presentation\Sprite::fromBitmap($bitmap)
            ->moved($screen->fullArea()->topLeft())
            ->resized($screen->fullArea()->size())
        );
    }

    /** @var Graphic\Color */
    private $color;
}
