<?php

namespace RevealPhp\Adapter\SDL\Render\PostRenderer;

use RevealPhp\Adapter\SDL\Render\PostRenderer;
use RevealPhp\Presentation;

class Stack implements PostRenderer
{
    public function __construct(PostRenderer ...$postRenderers)
    {
        $this->postRenderers = $postRenderers;
    }

    public function render($sdlRenderer, Presentation\Screen $screen): void
    {
        foreach ($this->postRenderers as $postRenderer) {
            $postRenderer->render($sdlRenderer, $screen);
        }
    }

    /** @var array<PostRenderer> */
    private $postRenderers;
}
