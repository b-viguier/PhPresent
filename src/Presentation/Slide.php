<?php

namespace PhPresent\Presentation;

use PhPresent\Graphic;

interface Slide
{
    /**
     * @return Frame|\Generator
     */
    public function render(Timestamp $timestamp, Screen $screen, Graphic\Drawer $drawer, Graphic\Theme $theme);
}
