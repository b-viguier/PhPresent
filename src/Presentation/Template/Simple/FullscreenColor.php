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

    public function render(Geometry\Size $size, Graphic\Drawer $drawer, Graphic\Theme $theme): Presentation\TraversableSprites
    {
        $origin = Geometry\Point::origin();
        $bitmap = $drawer->drawRectangle(
            Geometry\Rect::fromOriginAndSize(
                $origin,
                $size
            ),
            $theme->brush()
                ->withFillColor($this->color)
                ->withStrokeColor($this->color)
        )->createBitmap($size);

        return Presentation\Sprite::fromBitmap(
            $bitmap,
            $origin
        );
    }

    /** @var Graphic\Color */
    private $color;
}
