<?php

namespace RevealPhp\Presentation;

interface TraversableSprites
{
    /** @return iterable<Sprite> */
    public function iterate(): iterable;
}
