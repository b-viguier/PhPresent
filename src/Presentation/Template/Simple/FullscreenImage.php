<?php

namespace PhPresent\Presentation\Template\Simple;

use PhPresent\Geometry;
use PhPresent\Graphic;
use PhPresent\Presentation;

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
        $minSize = $screenAreaInImageSpace->size()->intersectedBy($screen->fullArea()->size());

        return new Presentation\Frame(Presentation\Sprite::fromBitmap(
            $drawer
                ->drawBitmap(
                    $this->bitmap,
                    $screenAreaInImageSpace,
                    Geometry\Rect::fromSize($minSize)
                )
                ->toBitmap($minSize)
            )->moved($screen->fullArea()->topLeft())
            ->resized($screen->fullArea()->size())
        );
    }

    /** @var Graphic\Bitmap */
    private $bitmap;
}
