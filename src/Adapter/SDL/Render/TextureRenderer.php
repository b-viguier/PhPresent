<?php

namespace RevealPhp\Adapter\SDL\Render;

interface TextureRenderer
{
    public function render($renderer, Texture $texture): void;
}
