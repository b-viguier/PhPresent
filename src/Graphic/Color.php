<?php

namespace RevealPhp\Graphic;

use RevealPhp\Pattern;

class Color
{
    public static function RGB(int $red, int $green, int $blue, int $alpha = 255): self
    {
        $color = new self();
        $color->r = self::sanitizeValue($red);
        $color->g = self::sanitizeValue($green);
        $color->b = self::sanitizeValue($blue);
        $color->a = self::sanitizeValue($alpha);

        return $color;
    }

    public static function black(): self
    {
        return self::RGB(0, 0, 0);
    }

    public static function white(): self
    {
        return self::RGB(255, 255, 255);
    }

    /**
     * Pattern: #RRGGBBAA
     */
    public function hex(): string
    {
        return '#'.str_pad(
                dechex($this->r * (1 << 24) + $this->g * (1 << 16) + $this->b * (1 << 8) + $this->a),
                8, '0', STR_PAD_LEFT
            );
    }

    private static function sanitizeValue(int $value): int
    {
        if ($value < 0 || $value > 255) {
            throw new Exception\ColorException();
        }

        return $value;
    }

    use Pattern\PrivateConstructor;

    /** @var int */
    private $r = 0;
    /** @var int */
    private $g = 0;
    /** @var int */
    private $b = 0;
    /** @var int */
    private $a = 0;
}
