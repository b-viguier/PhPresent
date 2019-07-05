<?php

namespace RevealPhp\Adapter\SDL\Render\PostRenderer;

use RevealPhp\Adapter\SDL\Render\PostRenderer;
use RevealPhp\Presentation;

class NoOp implements PostRenderer
{
    public function render($sdlRenderer, Presentation\Screen $screen): void
    {
        // Do Nothing…
    }
}
