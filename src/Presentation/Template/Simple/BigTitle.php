<?php

namespace PhPresent\Presentation\Template\Simple;

use PhPresent\Graphic;
use PhPresent\Presentation;

class BigTitle implements Presentation\Slide
{
    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function preload(Presentation\Screen $screen, Graphic\Drawer $drawer, Graphic\Theme $theme): void
    {
        $font = $theme->fontH1()
            ->relativeTo($screen->safeArea()->size()->height())
            ->withAlignment(Graphic\Font::ALIGN_CENTER);

        $text = $drawer->createText($this->title, $font);
        $bitmap = $drawer->drawText($text)
            ->toBitmap($text->area()->size());

        $spritePosition = $text->area()->centeredOn($screen->safeArea()->center())->topLeft();

        $this->frame = new Presentation\Frame(Presentation\Sprite::fromBitmap($bitmap)
            ->moved($spritePosition)
        );
    }

    public function render(Presentation\Timestamp $timestamp, Presentation\Screen $screen, Graphic\Drawer $drawer, Graphic\Theme $theme)
    {
        return $this->frame;
    }

    /** @var string */
    private $title = '';
    /** @var Presentation\Frame */
    private $frame;
}
