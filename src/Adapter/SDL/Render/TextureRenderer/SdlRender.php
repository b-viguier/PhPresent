<?php

namespace RevealPhp\Adapter\SDL\Render\TextureRenderer;

use RevealPhp\Adapter\SDL\Render\Texture;
use RevealPhp\Adapter\SDL\Render\TextureRenderer;

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
