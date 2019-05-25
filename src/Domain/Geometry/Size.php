<?php

namespace RevealPhp\Domain\Geometry;

use RevealPhp\Domain\Pattern;

class Size
{
    public static function fromDimensions(float $width, float $height): self
    {
        $size = new self();
        $size->width = self::sanitize($width);
        $size->height = self::sanitize($height);

        return $size;
    }

    public function width(): float
    {
        return $this->width;
    }

    public function height(): float
    {
        return $this->height;
    }

    use Pattern\PrivateConstructor;

    private static function sanitize(float $value): float
    {
        if ($value <= 0) {
            throw new Exception\SizeException();
        }

        return $value;
    }

    /** @var float */
    private $width = 0.0;
    /** @var float */
    private $height = 0.0;
}
