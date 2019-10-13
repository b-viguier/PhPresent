<?php

namespace PhPresent\Adapter\SDL\Render;

interface TextureRenderer
{
    public function render($renderer, Texture $texture): void;
}
