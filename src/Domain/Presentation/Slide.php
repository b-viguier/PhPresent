<?php

namespace RevealPhp\Domain\Presentation;

use Imagine\Draw\DrawerInterface;
use Imagine\Image\BoxInterface;
use Imagine\Image\Palette\PaletteInterface;
use RevealPhp\Domain\Render;

interface Slide
{
    public function render(DrawerInterface $drawer, BoxInterface $dimensions, PaletteInterface $palette): string;
}
