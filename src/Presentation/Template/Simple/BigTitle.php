<?php

namespace RevealPhp\Presentation\Template\Simple;

use RevealPhp\Geometry;
use RevealPhp\Graphic;
use RevealPhp\Presentation;

class BigTitle implements Presentation\Slide
{
    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function render(Geometry\Size $size, Graphic\Drawer $drawer, Graphic\Theme $theme): Presentation\TraversableSprites
    {
        $bitmap = $drawer->drawText(
            $this->title,
            Geometry\Point::fromCoordinates($size->width() / 2, $size->height() / 2),
            $theme->font()
                ->withAlignment(Graphic\Font::ALIGN_CENTER)
                ->withSize($size->height() / 6),
            $theme->brush()
        )->createBitmap($size);

        return Presentation\Sprite::fromBitmap($bitmap, Geometry\Point::origin());
    }

    /** @var string */
    private $title = '';
}
