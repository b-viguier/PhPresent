<?php

namespace RevealPhp\Domain\Presentation;

use RevealPhp\Domain\Render;

class SlideShow
{
    public function addSlide(Slide $slide): self
    {
        $this->slides[] = $slide;

        return $this;
    }

    public function currentImage(Render\Drawer $drawer): string
    {
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
