<?php

namespace PhPresent\Presentation;

class Frame
{
    public function __construct(TraversableSprites $sprite, TraversableSprites ...$sprites)
    {
        $this->sprites = array_merge([$sprite], $sprites);
    }

    public function withPushedSprites(TraversableSprites ...$sprites): self
    {
        $frame = new self(...$this->sprites, ...$sprites);

        return $frame;
    }

    public function sprites(): TraversableSprites
    {
        return new SpriteStack(...$this->sprites);
    }

    /** @var TraversableSprites[] */
    private $sprites = [];
}
