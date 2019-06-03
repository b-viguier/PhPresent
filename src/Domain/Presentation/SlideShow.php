<?php

namespace RevealPhp\Domain\Presentation;

use Imagine\Draw\DrawerInterface;
use Imagine\Image\BoxInterface;
use Imagine\Image\Palette\PaletteInterface;
use Imagine\Image\Point;

class SlideShow
{
    public function addSlide(Slide $slide): self
    {
        $this->slides[] = $slide;

        return $this;
    }

    public function currentImage(DrawerInterface $drawer, BoxInterface $dimensions, PaletteInterface $palette): string
    {
        // Draw background
        $drawer->rectangle(
            new Point(0, 0),
            new Point($dimensions->getWidth() - 1, $dimensions->getHeight() - 1),
            $palette->color('#0F0')
        );

        /** @var Slide */
        $slide = $this->slides[$this->currentIndex];

        return $slide->render($drawer, $dimensions, $palette);
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
