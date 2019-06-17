<?php

namespace RevealPhp\Graphic;

use RevealPhp\Geometry;
use RevealPhp\Pattern;

class Bitmap
{
    use Pattern\PrivateConstructor;

    public static function fromBmpContent(string $content, Geometry\Size $size): self
    {
        $bitmap = new self();
        $bitmap->content = $content;
        $bitmap->size = $size;

        return $bitmap;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function size(): Geometry\Size
    {
        return $this->size;
    }

    /** @var string */
    private $content = '';
    /** @var Geometry\Size */
    private $size;
}