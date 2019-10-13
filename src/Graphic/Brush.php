<?php

namespace PhPresent\Graphic;

use PhPresent\Pattern;

class Brush implements Pattern\Identifiable
{
    public static function createFrame(Color $color): self
    {
        return (new self())
            ->withFillColor(Color::none())
            ->withStrokeColor($color)
            ->withStrokeWidth(1);
    }

    public static function createFilled(Color $color): self
    {
        return (new self())
            ->withFillColor($color)
            ->withStrokeColor($color)
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

    public function identifier(): Pattern\Identifier
    {
        return Pattern\Identifier::fromString(
            self::class,
            $this->strokeWidth(),
            $this->strokeColor->identifier(),
            $this->fillColor->identifier()
        );
    }

    use Pattern\PrivateConstructor;

    /** @var int */
    private $strokeWidth;
    /** @var Color */
    private $strokeColor;
    /** @var Color */
    private $fillColor;
}
