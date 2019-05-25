<?php

namespace RevealPhp\Domain\Render;

use RevealPhp\Domain\Geometry;
use RevealPhp\Domain\Graphic;

interface Drawer
{
    public function clear(): self;

    public function getArea(): Geometry\Rect;

    public function rectangle(Geometry\Rect $rect, Graphic\ShapeBrush $shapeBrush): self;

    public function getBmpData(): string;
}
