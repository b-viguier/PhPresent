<?php

namespace PhPresent\Graphic;

use PhPresent\Geometry;
use PhPresent\Pattern;

class BitmapSequence implements Pattern\Identifiable
{
    use Pattern\PrivateConstructor;

    public static function fromFrames(Geometry\Size $size, BitmapSequenceFrame $firstFrame, BitmapSequenceFrame ...$frames): self
    {
        $bitmap = new self();
        $bitmap->size = $size;
        $bitmap->frames = $frames;
        array_unshift($bitmap->frames, $firstFrame);

        foreach ($bitmap->frames as $frame) {
            $bitmap->frameStarts[] = $bitmap->duration;
            $bitmap->duration += $frame->duration();
        }

        return $bitmap;
    }

    public function content(int $time): Bitmap
    {
        $time = max($time, 0) % $this->duration;
        $leftIndex = 0;
        $rightIndex = count($this->frameStarts) - 1;

        while ($rightIndex - $leftIndex > 1) {
            $newIndex = intdiv($leftIndex + $rightIndex, 2);
            if ($time < $this->frameStarts[$newIndex]) {
                $rightIndex = $newIndex;
            } else {
                $leftIndex = $newIndex;
            }
        }

        return Bitmap::fromBmpContent($this->frames[$leftIndex]->content(), $this->size);
    }

    public function size(): Geometry\Size
    {
        return $this->size;
    }

    public function duration(): int
    {
        return $this->duration;
    }

    public function identifier(): Pattern\Identifier
    {
        return Pattern\Identifier::fromIdentifiable(
            self::class,
            $this->size,
            ...$this->frames
        );
    }

    /** @var BitmapSequenceFrame[] */
    private $frames = [];
    /** @var int */
    private $duration = 0;
    /** @var Geometry\Size */
    private $size;
    /** @var array<int> */
    private $frameStarts = [];
}
