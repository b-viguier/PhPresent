<?php

namespace RevealPhp\Presentation\Template\Simple;

use RevealPhp\Graphic;
use RevealPhp\Presentation;

class TitleAndSubtitle implements Presentation\Slide
{
    public function __construct(string $title, string $subTitle)
    {
        $this->title = $title;
        $this->subTitle = $subTitle;
    }

    public function render(Presentation\Timestamp $timestamp, Presentation\Screen $screen, Graphic\Drawer $drawer, Graphic\Theme $theme)
    {
        $screenCenter = $screen->safeArea()->center();
        $screenHeight = $screen->safeArea()->size()->height();

        // Title
        $font = $theme->fontH1()
            ->relativeTo($screenHeight)
            ->withAlignment(Graphic\Font::ALIGN_CENTER);

        $text = $drawer->createText($this->title, $font);
        $bitmap = $drawer->drawText($text)
            ->toBitmap($text->area()->size());

        $spritePosition = $text->area()->hCenteredWith($screenCenter)->bottomAlignedWith($screenCenter)->topLeft();

        $titleSprite = Presentation\Sprite::fromBitmap($bitmap)->moved($spritePosition);

        // Subtitle
        $drawer->clear();
        $font = $theme->fontH2()
            ->relativeTo($screenHeight)
            ->withAlignment(Graphic\Font::ALIGN_CENTER);

        $text = $drawer->createText($this->subTitle, $font);
        $bitmap = $drawer->drawText($text)
            ->toBitmap($text->area()->size());

        $spritePosition = $text->area()->hCenteredWith($screenCenter)->topAlignedWith($screenCenter)->topLeft();

        $subtitleSprite = Presentation\Sprite::fromBitmap($bitmap)->moved($spritePosition);

        return new Presentation\Frame($titleSprite, $subtitleSprite);
    }

    /** @var string */
    private $title;
    /** @var string */
    private $subTitle;
}
