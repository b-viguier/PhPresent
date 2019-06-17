<?php

namespace RevealPhp\Graphic;

class SpriteStack implements TraversableSprites
{
    public function push(TraversableSprites $spriteList): self
    {
        $this->children[] = $spriteList;

        return $this;
    }

    public function iterate(): iterable
    {
        foreach ($this->children as $traversableSpriteList) {
            yield from $traversableSpriteList->iterate();
        }
    }

    /** @var array<TraversableSprites> */
    private $children = [];
}
