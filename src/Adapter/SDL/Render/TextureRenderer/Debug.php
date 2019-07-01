<?php

namespace RevealPhp\Adapter\SDL\Render\TextureRenderer;

use RevealPhp\Adapter\SDL\Render\Texture;
use RevealPhp\Adapter\SDL\Render\TextureRenderer;

class Debug implements TextureRenderer
{
    public function __construct(TextureRenderer $textureRenderer)
    {
        $this->textureRenderer = $textureRenderer;
    }

    public function render($sdlRenderer, Texture $texture): void
    {
        $this->textureRenderer->render($sdlRenderer, $texture);

        $dst = $texture->destination();
        \SDL_SetRenderDrawColor($sdlRenderer, 255, 0, 0, 255);
        \SDL_RenderDrawRect($sdlRenderer, $dst);
        \SDL_RenderDrawLine($sdlRenderer, $dst->x, $dst->y, $dst->x + $dst->w, $dst->y + $dst->h);
    }

    /** @var TextureRenderer */
    private $textureRenderer;
}
