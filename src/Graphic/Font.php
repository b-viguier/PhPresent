<?php

namespace RevealPhp\Graphic;

use RevealPhp\Pattern;

class Font
{
    public const ALIGN_LEFT = 1;
    public const ALIGN_RIGHT = 2;
    public const ALIGN_CENTER = 3;

    public static function createDefault(): self
    {
        return (new self())
            ->withFontFile(__DIR__.'/../../assets/fonts/times-new-roman.ttf')
            ->withSize(50)
            ->withAlignment(self::ALIGN_CENTER)
            ;
    }

    public function withFontFile(string $filepath): self
    {
        if (!file_exists($filepath) || !is_readable($filepath)) {
            throw new Exception\FontException("Font file [$filepath] is not readable.");
        }

        $font = clone $this;
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

    public function withAlignment(int $alignmentConstant): self
    {
        if (
            $alignmentConstant !== self::ALIGN_LEFT
            && $alignmentConstant !== self::ALIGN_RIGHT
            && $alignmentConstant !== self::ALIGN_CENTER
        ) {
            throw new Exception\FontException('Invalid alignment value');
        }

        $font = clone $this;
        $font->alignment = $alignmentConstant;

        return $font;
    }

    public function alignment(): int
    {
        return $this->alignment;
    }

    use Pattern\PrivateConstructor;

    /** @var string */
    private $fontFile;
    /** @var float */
    private $size;
    /** @var int */
    private $alignment;
}
