<?php

namespace RevealPhp\Graphic;

interface TraversableSprites
{
    /** @return iterable<Sprite> */
    public function iterate(): iterable;
}
