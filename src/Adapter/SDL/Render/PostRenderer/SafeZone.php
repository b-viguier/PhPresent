<?php

namespace PhPresent\Adapter\SDL\Render\PostRenderer;

use PhPresent\Adapter\SDL\Render\PostRenderer;
use PhPresent\Presentation;

class SafeZone implements PostRenderer
{
    public function render($sdlRenderer, Presentation\Screen $screen): void
    {
        $topLeft = $screen->safeArea()->topLeft();
        $size = $screen->safeArea()->size();

        \SDL_SetRenderDrawColor($sdlRenderer, 0, 255, 0, 255);
        \SDL_RenderDrawRect(
            $sdlRenderer,
            new \SDL_Rect(
                (int) $topLeft->x(),
                (int) $topLeft->y(),
                (int) $size->width(),
                (int) $size->height()
            )
        );
    }
}
