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

    public function render(Presentation\Screen $screen, Graphic\Drawer $drawer, Graphic\Theme $theme): Presentation\TraversableSprites
    {
        $imageSpace = Geometry\Rect::fromSize($this->bitmap->size());
        $screenAreaInImageSpace = $imageSpace->insideRect($screen->fullArea()->size()->ratio());

        return Presentation\Sprite::fromBitmap(
            $drawer
                ->drawBitmap(
                    $this->bitmap,
                    $screenAreaInImageSpace,
                    $screen->fullArea()
                )
                ->toBitmap($screen->fullArea()->size()),
            $screen->fullArea()->topLeft()
        );
    }

    /** @var Graphic\Bitmap */
    private $bitmap;
}
