<?php

namespace PhPresent\Render;

use PhPresent\Graphic;
use PhPresent\Presentation;

interface Engine
{
    public function start(Presentation\SlideShow $slideShow, Graphic\Drawer $drawer);
}
