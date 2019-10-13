<?php

namespace RevealPhp\Presentation\Template\Simple;

use RevealPhp\Geometry;
use RevealPhp\Graphic;
use RevealPhp\Presentation;

class FullscreenAnimatedImage implements Presentation\Slide
{
    public function __construct(Graphic\BitmapSequence $bitmapSequence)
    {
        $this->bitmapSequence = $bitmapSequence;
    }

    public function render(Presentation\Timestamp $timestamp, Presentation\Screen $screen, Graphic\Drawer $drawer, Graphic\Theme $theme)
    {
        $imageSpace = Geometry\Rect::fromSize($this->bitmapSequence->size());
        $screenAreaInImageSpace = $imageSpace->insideRect($screen->fullArea()->size()->ratio());

        while (true) {
            $timestamp = yield new Presentation\Frame(Presentation\Sprite::fromBitmap(
                $drawer
                    ->drawBitmap(
                        $this->bitmapSequence->content($timestamp->slideRelative()),
                        $screenAreaInImageSpace,
                        Geometry\Rect::fromSize($screen->fullArea()->size())
                    )
                    ->toBitmap($screen->fullArea()->size())
                )->moved($screen->fullArea()->topLeft())
            );
        }
    }

    /** @var Graphic\BitmapSequence */
    private $bitmapSequence;
}
