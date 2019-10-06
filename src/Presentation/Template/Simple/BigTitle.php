<?php

namespace RevealPhp\Presentation\Template\Simple;

use RevealPhp\Graphic;
use RevealPhp\Presentation;

class BigTitle implements Presentation\Slide
{
    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function render(Presentation\Timestamp $timestamp, Presentation\Screen $screen, Graphic\Drawer $drawer, Graphic\Theme $theme)
    {
        $font = $theme->fontH1()
            ->relativeTo($screen->safeArea()->size()->height())
            ->withAlignment(Graphic\Font::ALIGN_CENTER);

        $text = $drawer->createText($this->title, $font);
        $bitmap = $drawer->drawText($text)
            ->toBitmap($text->area()->size());

        $spritePosition = $text->area()->centeredOn($screen->safeArea()->center())->topLeft();

        return new Presentation\Frame(Presentation\Sprite::fromBitmap($bitmap, $spritePosition));
    }

    /** @var string */
    private $title = '';
}
