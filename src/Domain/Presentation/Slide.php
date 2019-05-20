<?php

namespace RevealPhp\Domain\Presentation;

use RevealPhp\Domain\Render;

interface Slide
{
    public function render(Render\Drawer $drawer): string;
}
