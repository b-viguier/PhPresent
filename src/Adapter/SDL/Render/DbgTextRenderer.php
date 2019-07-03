<?php

namespace RevealPhp\Adapter\SDL\Render;

use RevealPhp\Geometry;
use RevealPhp\Pattern;

class DbgTextRenderer
{
    use Pattern\PrivateConstructor;

    public static function create($sdlRenderer): self
    {
        $dbgTextRenderer = new self();

        $filepath = __DIR__.'/../../../../assets/images/font.bmp';
        $image = \SDL_LoadBMP($filepath);
        if ($image === null) {
            throw new Exception\RenderException("Unable to load '$filepath'.");
        }
        \SDL_SetColorKey($image, true, \SDL_MapRGB($image->format, 255, 0, 255));
        $dbgTextRenderer->sdlTexture = \SDL_CreateTextureFromSurface($sdlRenderer, $image);
        \SDL_FreeSurface($image);

        return $dbgTextRenderer;
    }

    public function render($sdlRenderer, string $text, Geometry\Point $point, int $size): void
    {
        $xCursor = (int) $point->x();
        $yCursor = (int) $point->y();

        // Draw background
        $lines = explode("\n", $text);
        $maxLength = max(1, ...array_map('strlen', $lines));
        \SDL_SetRenderDrawColor($sdlRenderer, 0, 0, 0, 220);
        \SDL_RenderFillRect(
            $sdlRenderer,
            new \SDL_Rect($xCursor, $yCursor, $maxLength * $size, count($lines) * $size)
        );

        // Draw text
        for ($i = 0, $length = strlen($text); $i < $length; ++$i) {
            $char = $text[$i];
            switch ($char) {
                case "\n":
                    $xCursor = (int) $point->x();
                    $yCursor += $size;
                    break;
                case ' ':
                    $xCursor += $size;
                    break;
                default:
                    if (isset(self::CHAR_MAP[$char])) {
                        \SDL_RenderCopy(
                            $sdlRenderer,
                            $this->sdlTexture,
                            new \SDL_Rect(self::CHAR_MAP[$char], 0, self::CHAR_SIZE, self::CHAR_SIZE),
                            new \SDL_Rect($xCursor, $yCursor, $size, $size)
                        );
                    }
                    $xCursor += $size;
                    break;
            }
        }
    }

    private $sdlTexture;
    private const CHAR_SIZE = 8;
    private const CHAR_MAP = [
        '+' => 1 * self::CHAR_SIZE,
        ',' => 2 * self::CHAR_SIZE,
        '-' => 3 * self::CHAR_SIZE,
        '.' => 4 * self::CHAR_SIZE,
        '/' => 5 * self::CHAR_SIZE,
        '0' => 6 * self::CHAR_SIZE,
        '1' => 7 * self::CHAR_SIZE,
        '2' => 8 * self::CHAR_SIZE,
        '3' => 9 * self::CHAR_SIZE,
        '4' => 10 * self::CHAR_SIZE,
        '5' => 11 * self::CHAR_SIZE,
        '6' => 12 * self::CHAR_SIZE,
        '7' => 13 * self::CHAR_SIZE,
        '8' => 14 * self::CHAR_SIZE,
        '9' => 15 * self::CHAR_SIZE,
        ':' => 16 * self::CHAR_SIZE,
        ';' => 17 * self::CHAR_SIZE,
        '<' => 18 * self::CHAR_SIZE,
        '=' => 19 * self::CHAR_SIZE,
        '>' => 20 * self::CHAR_SIZE,
        '?' => 21 * self::CHAR_SIZE,
        '©' => 22 * self::CHAR_SIZE,
        'A' => 23 * self::CHAR_SIZE,
        'B' => 24 * self::CHAR_SIZE,
        'C' => 25 * self::CHAR_SIZE,
        'D' => 26 * self::CHAR_SIZE,
        'E' => 27 * self::CHAR_SIZE,
        'F' => 28 * self::CHAR_SIZE,
        'G' => 29 * self::CHAR_SIZE,
        'H' => 30 * self::CHAR_SIZE,
        'I' => 31 * self::CHAR_SIZE,
        'J' => 32 * self::CHAR_SIZE,
        'K' => 33 * self::CHAR_SIZE,
        'L' => 34 * self::CHAR_SIZE,
        'M' => 35 * self::CHAR_SIZE,
        'N' => 36 * self::CHAR_SIZE,
        'O' => 37 * self::CHAR_SIZE,
        'P' => 38 * self::CHAR_SIZE,
        'Q' => 39 * self::CHAR_SIZE,
        'R' => 40 * self::CHAR_SIZE,
        'S' => 41 * self::CHAR_SIZE,
        'T' => 42 * self::CHAR_SIZE,
        'U' => 43 * self::CHAR_SIZE,
        'V' => 44 * self::CHAR_SIZE,
        'W' => 45 * self::CHAR_SIZE,
        'X' => 46 * self::CHAR_SIZE,
        'Y' => 47 * self::CHAR_SIZE,
        'Z' => 48 * self::CHAR_SIZE,
        '"' => 49 * self::CHAR_SIZE,
        '_' => 50 * self::CHAR_SIZE,
        '→' => 51 * self::CHAR_SIZE,
        '*' => 52 * self::CHAR_SIZE,
        '!' => 53 * self::CHAR_SIZE,
    ];
}
