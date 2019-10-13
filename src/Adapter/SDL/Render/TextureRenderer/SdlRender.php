<?php

namespace PhPresent\Adapter\SDL\Render\TextureRenderer;

use PhPresent\Adapter\SDL\Render\Texture;
use PhPresent\Adapter\SDL\Render\TextureRenderer;

class SdlRender implements TextureRenderer
{
    public function render($sdlRenderer, Texture $texture): void
    {
        \SDL_RenderCopy(
            $sdlRenderer,
            $texture->sdlTexture(),
            null,
            $texture->destination()
        );
    }
}
