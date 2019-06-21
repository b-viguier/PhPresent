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

        $bitmap = $drawer->drawText(
            $this->title,
            Geometry\Point::origin(),
            $font
        )->createBitmap($textSize);

        $spritePosition = Geometry\Point::fromCoordinates(
            ($size->width() - $textSize->width()) / 2,
            ($size->height() - $textSize->height()) / 2
        );

        return Presentation\Sprite::fromBitmap($bitmap, $spritePosition);
    }

    /** @var string */
    private $title = '';
}
