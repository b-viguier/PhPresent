<?php

namespace RevealPhp\Adapter\SDL\Render;

use RevealPhp\Presentation;

interface TextureLoader
{
    public function load($sdlRenderer, Presentation\Sprite $sprite): Texture;
}
