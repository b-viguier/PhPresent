<?php

namespace PhPresent\Adapter\SDL\Render;

class FrameRateLimiter
{
    public function __construct(int $fps, int $minimumPause = 5)
    {
        $this->frameDuration = (int) (1000 / $fps);
        $this->minimumPause = $minimumPause;
    }

    public function renderingStarts(): void
    {
        $this->startTime = $this->getTime();
    }

    public function pause()
    {
        SDL_Delay(max(
            $this->minimumPause,
            $this->frameDuration - ($this->getTime() - $this->startTime)
        ));
    }

    private function getTime(): int
    {
        return (int) (microtime(true) * 1000);
    }

    /** @var int */
    private $startTime;
    /** @var int */
    private $frameDuration;
    /** @var int */
    private $minimumPause;
}
