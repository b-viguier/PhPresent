<?php

namespace RevealPhp\Domain\Render;

use RevealPhp\Domain\Presentation;

interface Engine
{
    public function start(Presentation\SlideShow $slideShow, Drawer $drawer);
}
