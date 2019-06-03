<?php

namespace RevealPhp\Domain\Presentation\Slide;

use Imagine\Draw\DrawerInterface;
use Imagine\Image\BoxInterface;
use Imagine\Image\Palette\PaletteInterface;
use Imagine\Image\Point;
use RevealPhp\Domain\Geometry;
use RevealPhp\Domain\Presentation;
use RevealPhp\Domain\Render;

class Rectangle implements Presentation\Slide
{
    public function __construct(Geometry\Rect $rect)
    {
        $this->rect = $rect;
    }

    public function render(DrawerInterface $drawer, BoxInterface $dimensions, PaletteInterface $palette): string
    {
        $drawer->rectangle(
            new Point((int) $this->rect->topLeft()->x(), (int) $this->rect->topLeft()->y()),
            new Point((int) $this->rect->bottomRight()->x(), (int) $this->rect->bottomRight()->y()),
            $palette->color('#F00')
        );

        return '';
    }

    /** @var Geometry\Rect */
    private $rect;
}
