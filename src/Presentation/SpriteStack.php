<?php

namespace RevealPhp\Presentation;

class SpriteStack implements TraversableSprites
{
    public function __construct(TraversableSprites ...$sprites)
    {
        $this->children = $sprites;
    }

    public function withSpritesPushed(TraversableSprites ...$spriteList): self
    {
        return new self(...$this->children, ...$spriteList);
    }

    public function getIterator(): \Traversable
    {
        foreach ($this->children as $traversableSpriteList) {
            yield from $traversableSpriteList->getIterator();
        }
    }

    /** @var array<TraversableSprites> */
    private $children = [];
}
