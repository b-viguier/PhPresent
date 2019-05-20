<?php

namespace RevealPhp\Domain\Render;

use RevealPhp\Domain\Geometry;

interface Drawer
{
    public function clear(): self;

    public function rectangle(Geometry\Rect $rect): self;

    public function getBmpData(): string;
}
