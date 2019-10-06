<?php

namespace RevealPhp\Presentation;

use RevealPhp\Graphic;

interface Slide
{
    /**
     * @return Frame|\Generator
     */
    public function render(Timestamp $timestamp, Screen $screen, Graphic\Drawer $drawer, Graphic\Theme $theme);
}
