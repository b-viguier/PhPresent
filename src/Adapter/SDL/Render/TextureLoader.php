<?php

namespace PhPresent\Adapter\SDL\Render;

use PhPresent\Presentation;

interface TextureLoader
{
    public function load($sdlRenderer, Presentation\Sprite $sprite): Texture;
}
