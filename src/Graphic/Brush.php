<?php

namespace RevealPhp\Graphic;

use RevealPhp\Pattern;

class Brush
{
    public static function createDefault(): self
    {
        return (new self())
            ->withFillColor(Color::RGB(255, 255, 255))
            ->withStrokeColor(Color::RGB(0, 0, 0))
            ->withStrokeWidth(1);
    }

    public function withStrokeWidth(int $width): self
    {
        $brush = clone $this;
        $brush->strokeWidth = $width;

        return $brush;
    }

    public function strokeWidth(): int
    {
        return $this->strokeWidth;
    }

    public function withStrokeColor(Color $color): self
    {
        $brush = clone $this;
        $brush->strokeColor = $color;

        return $brush;
    }

    public function strokeColor(): Color
    {
        return $this->strokeColor;
    }

    public function withFillColor(Color $color): self
    {
        $brush = clone $this;
        $brush->fillColor = $color;

        return $brush;
    }

    public function fillColor(): Color
    {
        return $this->fillColor;
    }

    use Pattern\PrivateConstructor;

    /** @var int */
    private $strokeWidth;
    /** @var Color */
    private $strokeColor;
    /** @var Color */
    private $fillColor;
}
