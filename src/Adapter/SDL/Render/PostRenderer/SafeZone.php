<?php

namespace RevealPhp\Adapter\SDL\Render\PostRenderer;

use RevealPhp\Adapter\SDL\Render\PostRenderer;
use RevealPhp\Presentation;

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
