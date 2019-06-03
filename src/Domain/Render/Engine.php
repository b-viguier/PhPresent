<?php

namespace RevealPhp\Domain\Render;

use Imagine\Image\ImagineInterface;
use RevealPhp\Domain\Presentation;

interface Engine
{
    public function start(Presentation\SlideShow $slideShow, ImagineInterface $drawer);
}
