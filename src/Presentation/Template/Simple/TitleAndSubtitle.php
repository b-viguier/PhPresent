<?php

namespace PhPresent\Presentation\Template\Simple;

use PhPresent\Graphic;
use PhPresent\Presentation;
use PhPresent\Presentation\Screen;

class TitleAndSubtitle implements Presentation\Slide
{
    public function __construct(string $title, string $subTitle)
    {
        $this->title = $title;
        $this->subTitle = $subTitle;
    }

    public function preload(Screen $screen, Graphic\Drawer $drawer, Graphic\Theme $theme): void
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

        $this->frame = new Presentation\Frame($titleSprite, $subtitleSprite);
    }

    public function render(Presentation\Timestamp $timestamp, Presentation\Screen $screen, Graphic\Drawer $drawer, Graphic\Theme $theme)
    {
        return $this->frame;
    }

    /** @var string */
    private $title;
    /** @var string */
    private $subTitle;
    /** @var Presentation\Frame */
    private $frame;
}
