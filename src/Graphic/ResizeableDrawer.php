<?php

namespace RevealPhp\Graphic;

use RevealPhp\Geometry;

interface ResizeableDrawer extends Drawer
{
    public function clear(Geometry\Size $size): self;
}
