<?php

namespace RevealPhp\Presentation;

use RevealPhp\Geometry;
use RevealPhp\Graphic;

interface Slide
{
    public function render(Geometry\Size $size, Graphic\Drawer $drawer, Graphic\Theme $theme): TraversableSprites;
}
