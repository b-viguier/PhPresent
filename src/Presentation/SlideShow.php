<?php

namespace RevealPhp\Presentation;

use RevealPhp\Geometry;
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

    public function currentSprites(Geometry\Size $size, Graphic\Drawer $drawer): TraversableSprites
    {
        $stack = new SpriteStack();
        $stack->push($this->backgroundSlide->render($size, $drawer, $this->theme));
        /** @var Slide */
        $slide = $this->slides[$this->currentIndex];

        $stack->push($slide->render($size, $drawer, $this->theme));

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
