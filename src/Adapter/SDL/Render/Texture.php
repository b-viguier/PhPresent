<?php

namespace RevealPhp\Adapter\SDL\Render;

use RevealPhp\Presentation;

class Texture
{
    public function __construct(Presentation\Sprite $sprite, $sdlTexture)
    {
        $topLeft = $sprite->origin();
        $size = $sprite->size();

        $this->destination = new \SDL_Rect(
            (int) $topLeft->x(),
            (int) $topLeft->y(),
            (int) $size->width(),
            (int) $size->height()
        );
        $this->sdlTexture = $sdlTexture;
    }

    public function sdlTexture()
    {
        return $this->sdlTexture;
    }

    public function destination(): \SDL_Rect
    {
        return $this->destination;
    }

    /** @var \SDL_Rect */
    private $destination;
    private $sdlTexture;
}
