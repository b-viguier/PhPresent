<?php

namespace PhPresent\Adapter\SDL\Render;

use PhPresent\Presentation;

interface PostRenderer
{
    public function render($sdlRenderer, Presentation\Screen $screen): void;
}
