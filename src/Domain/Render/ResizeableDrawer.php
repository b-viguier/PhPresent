<?php

namespace RevealPhp\Domain\Render;

use RevealPhp\Domain\Geometry;

interface ResizeableDrawer extends Drawer
{
    public function clear(Geometry\Size $size): self;
}
