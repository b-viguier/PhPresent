<?php

namespace RevealPhp\Domain\Render;

use RevealPhp\Domain\Geometry;

interface ResizeableDrawer extends Drawer
{
    public function setSize(Geometry\Size $size);
}
