<?php

namespace RevealPhp\Render;

use RevealPhp\Graphic;
use RevealPhp\Presentation;

interface Engine
{
    public function start(Presentation\SlideShow $slideShow, Graphic\Drawer $drawer);
}
