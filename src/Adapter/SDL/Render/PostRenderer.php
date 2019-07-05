<?php

namespace RevealPhp\Adapter\SDL\Render;

use RevealPhp\Presentation;

interface PostRenderer
{
    public function render($sdlRenderer, Presentation\Screen $screen): void;
}
