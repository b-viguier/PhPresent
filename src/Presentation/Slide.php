<?php

namespace RevealPhp\Presentation;

use RevealPhp\Render;

interface Slide
{
    public function render(Render\Drawer $drawer): string;
}
