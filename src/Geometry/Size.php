<?php

namespace RevealPhp\Geometry;

use RevealPhp\Pattern;

class Size implements Pattern\Identifiable
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

    public function ratio(): float
    {
        return $this->width / $this->height;
    }

    public function scaledBy(float $scale): self
    {
        $scale = self::sanitize($scale);
        $size = clone $this;
        $size->height = $this->height * $scale;
        $size->width = $this->width * $scale;

        return $size;
    }

    public function toVector(): Vector
    {
        return Vector::fromCoordinates($this->width, $this->height);
    }

    public function identifier(): Pattern\Identifier
    {
        return Pattern\Identifier::fromString(
            self::class,
            $this->width,
            $this->height
        );
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
