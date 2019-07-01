<?php

namespace RevealPhp\Adapter\SDL\Render\TextureLoader;

use RevealPhp\Adapter\SDL\Render\Texture;
use RevealPhp\Adapter\SDL\Render\TextureLoader;
use RevealPhp\Presentation;

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
