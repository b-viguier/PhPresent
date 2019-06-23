<?php

namespace RevealPhp\Presentation;

use RevealPhp\Graphic;

interface Slide
{
    public function render(Screen $screen, Graphic\Drawer $drawer, Graphic\Theme $theme): TraversableSprites;
}
