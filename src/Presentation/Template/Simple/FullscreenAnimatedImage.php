<?php

namespace PhPresent\Presentation\Template\Simple;

use PhPresent\Geometry;
use PhPresent\Graphic;
use PhPresent\Presentation;
use PhPresent\Presentation\Screen;

class FullscreenAnimatedImage implements Presentation\Slide
{
    public function __construct(Graphic\BitmapSequence $bitmapSequence)
    {
        $this->bitmapSequence = $bitmapSequence;
    }

    public function preload(Screen $screen, Graphic\Drawer $drawer, Graphic\Theme $theme): void
    {
    }

    public function render(Presentation\Timestamp $timestamp, Presentation\Screen $screen, Graphic\Drawer $drawer, Graphic\Theme $theme)
    {
        $imageSpace = Geometry\Rect::fromSize($this->bitmapSequence->size());
        $screenAreaInImageSpace = $imageSpace->insideRect($screen->fullArea()->size()->ratio());
        $minSize = $screenAreaInImageSpace->size()->intersectedBy($screen->fullArea()->size());

        while (true) {
            $timestamp = yield new Presentation\Frame(Presentation\Sprite::fromBitmap(
                $drawer
                    ->drawBitmap(
                        $this->bitmapSequence->content($timestamp->slideRelative()),
                        $screenAreaInImageSpace,
                        Geometry\Rect::fromSize($minSize)
                    )
                    ->toBitmap($minSize)
                )->moved($screen->fullArea()->topLeft())
                ->resized($screen->fullArea()->size())
            );
        }
    }

    /** @var Graphic\BitmapSequence */
    private $bitmapSequence;
}
