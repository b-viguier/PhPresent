<?php

namespace PhPresent\Presentation;

use PhPresent\Graphic;
use PhPresent\Pattern;

class AsyncSlideHandler
{
    public function __construct(Slide $slide)
    {
        $this->slide = $slide;
        $this->contextId = Pattern\Identifier::fromString(self::class, 'empty');
    }

    public function renderFrame(Timestamp $timestamp, Screen $screen, Graphic\Drawer $drawer, Graphic\Theme $theme): Frame
    {
        $contextId = Pattern\Identifier::fromIdentifiable(self::class, $screen, $theme);
        if (!$contextId->equals($this->contextId)) {
            $this->staticFrame = null;
            $this->frameGenerator = null;
            $this->contextId = $contextId;
        }

        if ($this->staticFrame) {
            return $this->staticFrame;
        }

        if ($this->frameGenerator) {
            try {
                $this->frameGenerator->send($timestamp);

                return $this->currentFrameFromGenerator();
            } catch (\Throwable $throwable) {
                // If a generator throw an exception, it cannot be used anymore
                $this->frameGenerator = null;
                echo "Failing Generator\n";
                throw $throwable;
            }
        }

        $frameOrGenerator = $this->slide->render($timestamp, $screen, $drawer, $theme);
        if ($frameOrGenerator instanceof \Generator) {
            $this->frameGenerator = $frameOrGenerator;

            try {
                return $this->currentFrameFromGenerator();
            } catch (\Throwable $throwable) {
                // If a generator throw an exception, it cannot be used anymore
                $this->frameGenerator = null;
                echo "Failing Generator\n";
                throw $throwable;
            }
        } elseif ($frameOrGenerator instanceof Frame) {
            return $this->staticFrame = $frameOrGenerator;
        }

        throw new \LogicException('Slide::renderFrames must return a Generator or a Frame');
    }

    private function currentFrameFromGenerator(): Frame
    {
        assert($this->frameGenerator !== null);
        if ($this->frameGenerator->valid()) {
            return $this->frameGenerator->current();
        }

        return $this->staticFrame = $this->frameGenerator->getReturn();
    }

    /** @var Slide */
    private $slide;
    /** @var Pattern\Identifier */
    private $contextId;
    /** @var ?\Generator */
    private $frameGenerator;
    /** @var ?Frame */
    private $staticFrame;
}
