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
        while (true) {
            $timestamp = yield new Presentation\Frame(
                Presentation\Sprite::fromBitmap($this->bitmapSequence->content($timestamp->slideRelative()))
                    ->moved($screen->fullArea()->topLeft())
                    ->resized($screen->fullArea()->size())
            );
        }
    }

    /** @var Graphic\BitmapSequence */
    private $bitmapSequence;
}
