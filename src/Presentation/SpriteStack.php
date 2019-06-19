<?php

namespace RevealPhp\Presentation;

class SpriteStack implements TraversableSprites
{
    public function push(TraversableSprites $spriteList): self
    {
        $this->children[] = $spriteList;

        return $this;
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
