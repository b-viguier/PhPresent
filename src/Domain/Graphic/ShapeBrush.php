<?php

namespace RevealPhp\Domain\Graphic;

use RevealPhp\Domain\Pattern;

class ShapeBrush
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
        $shapeBrush = clone $this;
        $shapeBrush->strokeWidth = $width;

        return $shapeBrush;
    }

    public function strokeWidth(): int
    {
        return $this->strokeWidth;
    }

    public function withStrokeColor(Color $color): self
    {
        $shapeBrush = clone $this;
        $shapeBrush->strokeColor = $color;

        return $shapeBrush;
    }

    public function strokeColor(): Color
    {
        return $this->strokeColor;
    }

    public function withFillColor(Color $color): self
    {
        $shapeBrush = clone $this;
        $shapeBrush->fillColor = $color;

        return $shapeBrush;
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
