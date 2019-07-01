<?php

namespace RevealPhp\Adapter\SDL\Render;

use RevealPhp\Presentation;

class Texture
{
    public function __construct(Presentation\Sprite $sprite, $sdlTexture)
    {
        $this->destination = new \SDL_Rect(
            (int) $sprite->position()->x(),
            (int) $sprite->position()->y(),
            (int) $sprite->bitmap()->size()->width(),
            (int) $sprite->bitmap()->size()->height()
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
