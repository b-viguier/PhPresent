<?php

namespace RevealPhp\Presentation;

use RevealPhp\Graphic;

class SlideShow
{
    public function __construct(Graphic\Theme $theme, Slide $backgroundSlide)
    {
        $this->theme = $theme;
        $this->backgroundSlide = $backgroundSlide;
    }

    public function addSlide(Slide $slide): self
    {
        $this->slides[] = $slide;

        return $this;
    }

    public function currentSprites(Screen $screen, Graphic\Drawer $drawer): TraversableSprites
    {
        $stack = new SpriteStack();

        $drawer->clear();
        $stack->push($this->backgroundSlide->render($screen, $drawer, $this->theme));

        /** @var Slide */
        $slide = $this->slides[$this->currentIndex];
        $drawer->clear();
        $stack->push($slide->render($screen, $drawer, $this->theme));

        return $stack;
    }

    public function next()
    {
        $this->currentIndex = min($this->currentIndex + 1, count($this->slides) - 1);
    }

    public function previous()
    {
        $this->currentIndex = max($this->currentIndex - 1, 0);
    }

    public function isLastSlide(): bool
    {
        return $this->currentIndex == count($this->slides) - 1;
    }

    /** @var array<Slide> */
    private $slides = [];
    /** @var int */
    private $currentIndex = 0;
    /** @var Graphic\Theme */
    private $theme;
    /** @var Slide */
    private $backgroundSlide;
}
