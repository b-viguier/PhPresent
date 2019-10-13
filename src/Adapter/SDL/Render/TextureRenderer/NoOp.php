<?php

namespace PhPresent\Adapter\SDL\Render\TextureRenderer;

use PhPresent\Adapter\SDL\Render\Texture;
use PhPresent\Adapter\SDL\Render\TextureRenderer;

class NoOp implements TextureRenderer
{
    public function render($renderer, Texture $texture): void
    {
        // Do Nothing
    }
}
