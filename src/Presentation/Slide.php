<?php

namespace PhPresent\Presentation;

use PhPresent\Graphic;

interface Slide
{
    public function preload(Screen $screen, Graphic\Drawer $drawer, Graphic\Theme $theme): void;

    /**
     * @return Frame|\Generator
     */
    public function render(Timestamp $timestamp, Screen $screen, Graphic\Drawer $drawer, Graphic\Theme $theme);
}
