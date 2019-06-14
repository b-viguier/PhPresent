<?php

namespace RevealPhp\Presentation;

use RevealPhp\Graphic;
use RevealPhp\Render;

interface Slide
{
    public function render(Render\Drawer $drawer, Graphic\Theme $theme): string;
}
