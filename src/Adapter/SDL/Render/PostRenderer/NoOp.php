<?php

namespace PhPresent\Adapter\SDL\Render\PostRenderer;

use PhPresent\Adapter\SDL\Render\PostRenderer;
use PhPresent\Presentation;

class NoOp implements PostRenderer
{
    public function render($sdlRenderer, Presentation\Screen $screen): void
    {
        // Do Nothing…
    }
}
