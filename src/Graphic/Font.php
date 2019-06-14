<?php

namespace RevealPhp\Graphic;

use RevealPhp\Pattern;

class Font
{
    public static function createDefault(): self
    {
        $font = new self();
        $font->fontFile = __DIR__.'/../../assets/fonts/times-new-roman.ttf';
        $font->size = 10;

        return $font;
    }

    public static function fromFile(string $filepath): self
    {
        $font = self::createDefault();
        $font->fontFile = $filepath;

        return $font;
    }

    public function fontFile(): string
    {
        return $this->fontFile;
    }

    public function withSize(float $size): self
    {
        $font = clone $this;
        $font->size = $size;

        return $font;
    }

    public function size(): float
    {
        return $this->size;
    }

    use Pattern\PrivateConstructor;

    /** @var string */
    private $fontFile;
    /** @var float */
    private $size;
}
