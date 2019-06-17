<?php

namespace RevealPhp\Graphic;

use RevealPhp\Geometry;
use RevealPhp\Pattern;

class Sprite implements TraversableSprites
{
    use Pattern\PrivateConstructor;

    public static function fromBitmap(Bitmap $bitmap, Geometry\Point $position): self
    {
        $sprite = new self();
        $sprite->bitmap = $bitmap;
        $sprite->position = $position;

        return $sprite;
    }

    public function bitmap(): Bitmap
    {
        return $this->bitmap;
    }

    public function position(): Geometry\Point
    {
        return $this->position;
    }

    public function iterate(): iterable
    {
        yield $this;
    }

    /** @var Bitmap */
    private $bitmap;
    /** @var Geometry\Point */
    private $position;
}
