<?php

namespace PhPresent\Adapter\SDL\Render\PostRenderer;

use PhPresent\Adapter\SDL\Render\PostRenderer;
use PhPresent\Presentation;

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
