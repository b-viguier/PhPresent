<?php

namespace RevealPhp\Presentation;

use RevealPhp\Geometry;
use RevealPhp\Graphic;
use RevealPhp\Pattern;

class Sprite implements TraversableSprites
{
    use Pattern\PrivateConstructor;

    public static function fromBitmap(Graphic\Bitmap $bitmap): self
    {
        $sprite = new self();
        $sprite->bitmap = $bitmap;
        $sprite->origin = Geometry\Point::origin();
        $sprite->size = $bitmap->size();

        return $sprite;
    }

    public function bitmap(): Graphic\Bitmap
    {
        return $this->bitmap;
    }

    public function origin(): Geometry\Point
    {
        return $this->origin;
    }

    public function moved(Geometry\Point $origin): self
    {
        $sprite = clone $this;
        $sprite->origin = $origin;

        return $sprite;
    }

    public function resized(Geometry\Size $size): self
    {
        $sprite = clone $this;
        $sprite->size = $size;

        return $sprite;
    }

    public function size(): Geometry\Size
    {
        return $this->size;
    }

    public function getIterator(): \Traversable
    {
        yield $this;
    }

    /** @var Graphic\Bitmap */
    private $bitmap;
    /** @var Geometry\Point */
    private $origin;
    /** @var Geometry\Size */
    private $size;
}
