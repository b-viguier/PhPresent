<?php

namespace RevealPhp\Presentation\Template\Simple;

use RevealPhp\Geometry;
use RevealPhp\Graphic;
use RevealPhp\Presentation;

class FullscreenImage implements Presentation\Slide
{
    public function __construct(Graphic\Bitmap $bitmap)
    {
        $this->bitmap = $bitmap;
    }

    public function render(Presentation\Timestamp $timestamp, Presentation\Screen $screen, Graphic\Drawer $drawer, Graphic\Theme $theme)
    {
        $imageSpace = Geometry\Rect::fromSize($this->bitmap->size());
        $screenAreaInImageSpace = $imageSpace->insideRect($screen->fullArea()->size()->ratio());

        return new Presentation\Frame(Presentation\Sprite::fromBitmap(
            $drawer
                ->drawBitmap(
                    $this->bitmap,
                    $screenAreaInImageSpace,
                    Geometry\Rect::fromSize($screen->fullArea()->size())
                )
                ->toBitmap($screen->fullArea()->size())
            )->moved($screen->fullArea()->topLeft())
        );
    }

    /** @var Graphic\Bitmap */
    private $bitmap;
}
