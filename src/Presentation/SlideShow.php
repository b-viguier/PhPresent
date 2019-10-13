<?php

namespace PhPresent\Presentation;

use PhPresent\Graphic;

class SlideShow
{
    public function __construct(Graphic\Theme $theme, Slide $backgroundSlide)
    {
        $this->theme = $theme;
        $this->backgroundSlide = new AsyncSlideHandler($backgroundSlide);
        $this->lastTimestamp = Timestamp::origin(microtime(true));
    }

    public function addSlide(Slide $slide): self
    {
        $this->slideHandlers[] = new AsyncSlideHandler($slide);

        return $this;
    }

    public function currentFrame(Screen $screen, Graphic\Drawer $drawer): Frame
    {
        $this->lastTimestamp = $this->lastTimestamp->nextFrame(microtime(true));

        $drawer->clear();
        $backgroundFrame = $this->backgroundSlide->renderFrame($this->lastTimestamp, $screen, $drawer, $this->theme);

        /** @var AsyncSlideHandler */
        $slide = $this->slideHandlers[$this->currentIndex];
        $drawer->clear();
        $foregroundFrame = $slide->renderFrame($this->lastTimestamp, $screen, $drawer, $this->theme);

        return $backgroundFrame->withPushedSprites(
            $foregroundFrame->sprites()
        );
    }

    public function next()
    {
        $this->currentIndex = min($this->currentIndex + 1, count($this->slideHandlers) - 1);
        $this->lastTimestamp = $this->lastTimestamp->nextSlide(microtime(true));
    }

    public function previous()
    {
        $this->currentIndex = max($this->currentIndex - 1, 0);
        $this->lastTimestamp = $this->lastTimestamp->nextSlide(microtime(true));
    }

    public function isLastSlide(): bool
    {
        return $this->currentIndex == count($this->slideHandlers) - 1;
    }

    public function preload(Screen $screen, Graphic\Drawer $drawer): Progress
    {
        $progress = new class() implements Progress {
            /** @var int */
            public $count;
            /** @var \Generator */
            public $advance;

            public function count(): int
            {
                return $this->count;
            }

            public function advance(): int
            {
                return $this->advance->send(null) ?? $this->count;
            }
        };

        $progress->count = 1 + count($this->slideHandlers);
        $progress->advance = (function () use ($drawer, $screen): \Generator {
            $current = 0;
            yield $current++;
            $drawer->clear();
            $this->backgroundSlide->slide()->preload($screen, $drawer, $this->theme);
            foreach ($this->slideHandlers as $slideHandler) {
                yield $current++;
                $drawer->clear();
                $slideHandler->slide()->preload($screen, $drawer, $this->theme);
            }
        })();

        return $progress;
    }

    /** @var array<AsyncSlideHandler> */
    private $slideHandlers = [];
    /** @var int */
    private $currentIndex = 0;
    /** @var Graphic\Theme */
    private $theme;
    /** @var AsyncSlideHandler */
    private $backgroundSlide;
    /** @var Timestamp */
    private $lastTimestamp;
}
