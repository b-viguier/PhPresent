<?php

namespace PhPresent\Adapter\SDL\Render\TextureLoader;

use PhPresent\Adapter\SDL\Render\Texture;
use PhPresent\Adapter\SDL\Render\TextureLoader;
use PhPresent\Presentation;

class Sprite implements TextureLoader
{
    public function load($sdlRenderer, Presentation\Sprite $sprite): Texture
    {
        $image = $sprite->bitmap()->content();
        $stream = \SDL_RWFromConstMem($image, strlen($image));
        unset($image);
        $surface = \SDL_LoadBMP_RW($stream, 1/*free*/);
        $texture = \SDL_CreateTextureFromSurface($sdlRenderer, $surface);
        \SDL_FreeSurface($surface);

        return new Texture($sprite, $texture);
    }
}
