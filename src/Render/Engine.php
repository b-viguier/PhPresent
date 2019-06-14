<?php

namespace RevealPhp\Render;

use RevealPhp\Presentation;

interface Engine
{
    public function start(Presentation\SlideShow $slideShow, ResizeableDrawer $drawer);
}
