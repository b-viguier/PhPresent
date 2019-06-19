<?php

namespace RevealPhp\Presentation;

use RevealPhp\Geometry;
use RevealPhp\Graphic;
use RevealPhp\Pattern;

class Sprite implements TraversableSprites
{
    use Pattern\PrivateConstructor;

    public static function fromBitmap(Graphic\Bitmap $bitmap, Geometry\Point $position): self
    {
        $sprite = new self();
        $sprite->bitmap = $bitmap;
        $sprite->position = $position;

        return $sprite;
    }

    public function bitmap(): Graphic\Bitmap
    {
        return $this->bitmap;
    }

    public function position(): Geometry\Point
    {
        return $this->position;
    }

    public function getIterator(): \Traversable
    {
        yield $this;
    }

    /** @var Graphic\Bitmap */
    private $bitmap;
    /** @var Geometry\Point */
    private $position;
}
