<?php

namespace RevealPhp\Adapter\SDL\Render\PostRenderer;

use RevealPhp\Adapter\SDL\Render\DbgTextRenderer;
use RevealPhp\Adapter\SDL\Render\PostRenderer;
use RevealPhp\Presentation;

class Statistics implements PostRenderer
{
    public function __construct(DbgTextRenderer $textRenderer)
    {
        $this->textRenderer = $textRenderer;
        $this->lastTimestamp = microtime(true);
    }

    public function render($sdlRenderer, Presentation\Screen $screen): void
    {
        $currentTimestamp = microtime(true);
        $fps = (int) (1 / ($currentTimestamp - $this->lastTimestamp));
        $this->lastTimestamp = $currentTimestamp;

        $mem = (int) (memory_get_usage() / 1000); /* for Kb */

        $this->textRenderer->render(
            $sdlRenderer,
            "FPS:$fps\nMEM:$mem KB",
            $screen->fullArea()->topLeft(),
            (int) ($screen->safeArea()->size()->height() / 30)
        );
    }

    /** @var DbgTextRenderer */
    private $textRenderer;

    /** @var float */
    private $lastTimestamp;
}
