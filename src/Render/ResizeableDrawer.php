<?php

namespace RevealPhp\Render;

use RevealPhp\Geometry;

interface ResizeableDrawer extends Drawer
{
    public function clear(Geometry\Size $size): self;
}
