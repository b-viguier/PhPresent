<?php

namespace PhPresent\Presentation\Template\Simple;

use PhPresent\Geometry;
use PhPresent\Graphic;
use PhPresent\Presentation;
use PhPresent\Presentation\Screen;

class FullscreenColor implements Presentation\Slide
{
    public function __construct(Graphic\Color $color)
    {
        $this->color = $color;
    }

    public function preload(Screen $screen, Graphic\Drawer $drawer, Graphic\Theme $theme): void
    {
        $bitmap = $drawer->drawRectangle(
            Geometry\Rect::fromSize($onePixelSize = Geometry\Size::fromDimensions(1, 1)),
            Graphic\Brush::createFilled($this->color)
        )->toBitmap($onePixelSize);

        $this->frame = new Presentation\Frame(Presentation\Sprite::fromBitmap($bitmap)
            ->moved($screen->fullArea()->topLeft())
            ->resized($screen->fullArea()->size())
        );
    }

    public function render(Presentation\Timestamp $timestamp, Presentation\Screen $screen, Graphic\Drawer $drawer, Graphic\Theme $theme)
    {
        return $this->frame;
    }

    /** @var Graphic\Color */
    private $color;
    /** @var Presentation\Frame */
    private $frame;
}
