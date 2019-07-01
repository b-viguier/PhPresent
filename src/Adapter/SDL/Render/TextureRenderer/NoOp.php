<?php

namespace RevealPhp\Adapter\SDL\Render\TextureRenderer;

use RevealPhp\Adapter\SDL\Render\Texture;
use RevealPhp\Adapter\SDL\Render\TextureRenderer;

class NoOp implements TextureRenderer
{
    public function render($renderer, Texture $texture): void
    {
        // Do Nothing
    }
}
