<?php

namespace RevealPhp\Presentation;

use RevealPhp\Graphic;
use RevealPhp\Render;

interface Slide
{
    public function render(Graphic\Drawer $drawer, Graphic\Theme $theme): string;
}
