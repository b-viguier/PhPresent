<?php

namespace PhPresent\Presentation\Template\Simple;

use PhPresent\Geometry;
use PhPresent\Graphic;
use PhPresent\Presentation;
use PhPresent\Presentation\Screen;

class TitleAndMovingSubtitle implements Presentation\Slide
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

        $this->titleSprite = Presentation\Sprite::fromBitmap(
            $bitmap
        )->moved($spritePosition);

        // Subtitle
        $drawer->clear();
        $font = $theme->fontH2()
            ->relativeTo($screenHeight)
            ->withAlignment(Graphic\Font::ALIGN_CENTER);

        $text = $drawer->createText($this->subTitle, $font);
        $bitmap = $drawer->drawText($text)
            ->toBitmap($text->area()->size());

        $this->subtitleSprite = Presentation\Sprite::fromBitmap($bitmap);
    }

    public function render(Presentation\Timestamp $timestamp, Presentation\Screen $screen, Graphic\Drawer $drawer, Graphic\Theme $theme)
    {
        $screenCenter = $screen->safeArea()->center();

        $initialSpritePosition = Geometry\Rect::fromTopLeftAndSize(
            $this->subtitleSprite->origin(),
            $this->subtitleSprite->size()
        )->hCenteredWith($screenCenter)->topAlignedWith($screenCenter)->topLeft();

        while (true) {
            $spritePosition = $initialSpritePosition->movedBy(
                Geometry\Vector::fromCoordinates(sin($timestamp->slideRelative() / 1000) * 100, 0)
            );

            $timestamp = yield new Presentation\Frame(
                $this->titleSprite,
                $this->subtitleSprite->moved($spritePosition)
            );
        }
    }

    /** @var string */
    private $title;
    /** @var Presentation\Sprite */
    private $titleSprite;
    /** @var string */
    private $subTitle;
    /** @var Presentation\Sprite */
    private $subtitleSprite;
}
