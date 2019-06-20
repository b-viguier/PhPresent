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
        $font = $theme->font()
            ->withAlignment(Graphic\Font::ALIGN_CENTER)
            ->withSize($size->height() / 6);

        $textSize = $drawer->textDimensions($this->title, $font);
        $position = Geometry\Point::fromCoordinates(
            ($size->width() - $textSize->width()) / 2,
            ($size->height() - $textSize->height()) / 2
        );

        $bitmap = $drawer->drawText(
            $this->title,
            $position,
            $font,
            $theme->brush()
        )->createBitmap($size);

        return Presentation\Sprite::fromBitmap($bitmap, Geometry\Point::origin());
    }

    /** @var string */
    private $title = '';
}
