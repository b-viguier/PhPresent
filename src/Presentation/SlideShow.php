<?php

namespace RevealPhp\Presentation;

use RevealPhp\Graphic;
use RevealPhp\Render;

class SlideShow
{
    public function addSlide(Slide $slide): self
    {
        $this->slides[] = $slide;

        return $this;
    }

    public function currentImage(Render\Drawer $drawer): string
    {
        // Draw background
        $drawer->rectangle(
            $drawer->getArea(),
            Graphic\Brush::createDefault()
                ->withFillColor(Graphic\Color::black())
                ->withStrokeColor(Graphic\Color::RGB(255, 0, 0))
        );

        /** @var Slide */
        $slide = $this->slides[$this->currentIndex];

        return $slide->render($drawer);
    }

    public function next()
    {
        ++$this->currentIndex;
    }

    public function isFinished(): bool
    {
        return $this->currentIndex >= count($this->slides);
    }

    /** @var array<Slide> */
    private $slides = [];
    /** @var int */
    private $currentIndex = 0;
}
