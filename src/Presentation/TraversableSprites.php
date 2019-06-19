<?php

namespace RevealPhp\Presentation;

interface TraversableSprites extends \IteratorAggregate
{
    /** @return \Traversable<Sprite> */
    public function getIterator(): \Traversable;
}
