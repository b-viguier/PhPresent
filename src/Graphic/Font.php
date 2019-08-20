<?php

namespace RevealPhp\Graphic;

use RevealPhp\Pattern;

class Font implements Pattern\Identifiable
{
    public const ALIGN_LEFT = 1;
    public const ALIGN_RIGHT = 2;
    public const ALIGN_CENTER = 3;

    public const STYLE_REGULAR = 0;
    public const STYLE_BOLD = 1;
    public const STYLE_ITALIC = 2;
    public const STYLE_BOLD_ITALIC = 3;

    public static function createDefaultSans(): self
    {
        return (new self())
            ->withFontFiles(
                self::DEFAULT_FONT_PATH.'LiberationSans-Regular.ttf',
                self::DEFAULT_FONT_PATH.'LiberationSans-Bold.ttf',
                self::DEFAULT_FONT_PATH.'LiberationSans-Italic.ttf',
                self::DEFAULT_FONT_PATH.'LiberationSans-BoldItalic.ttf'
                )
            ->withStyle(self::STYLE_REGULAR)
            ->withSize(50)
            ->withAlignment(self::ALIGN_CENTER)
            ->withBrush(Brush::createFilled(Color::black()))
            ;
    }

    public static function createDefaultSerif(): self
    {
        return self::createDefaultSans()
            ->withFontFiles(
                self::DEFAULT_FONT_PATH.'LiberationSerif-Regular.ttf',
                self::DEFAULT_FONT_PATH.'LiberationSerif-Bold.ttf',
                self::DEFAULT_FONT_PATH.'LiberationSerif-Italic.ttf',
                self::DEFAULT_FONT_PATH.'LiberationSerif-BoldItalic.ttf'
            );
    }

    public static function createDefaultMono(): self
    {
        return self::createDefaultSans()
            ->withFontFiles(
                self::DEFAULT_FONT_PATH.'LiberationMono-Regular.ttf',
                self::DEFAULT_FONT_PATH.'LiberationMono-Bold.ttf',
                self::DEFAULT_FONT_PATH.'LiberationMono-Italic.ttf',
                self::DEFAULT_FONT_PATH.'LiberationMono-BoldItalic.ttf'
            );
    }

    public function withFontFiles(string $regularFile, ?string $boldFile = null, ?string $italicFile = null, ?string $boldItalicFile = null): self
    {
        $boldFile = $boldFile ?? $regularFile;
        $italicFile = $italicFile ?? $regularFile;
        $boldItalicFile = $boldItalicFile ?? $regularFile;

        $this->checkFontFile($regularFile);
        $this->checkFontFile($boldFile);
        $this->checkFontFile($italicFile);
        $this->checkFontFile($boldItalicFile);

        $font = clone $this;
        $font->fontFiles = \SplFixedArray::fromArray([
            self::STYLE_REGULAR => $regularFile,
            self::STYLE_BOLD => $boldFile,
            self::STYLE_ITALIC => $italicFile,
            self::STYLE_BOLD_ITALIC => $boldItalicFile,
        ]);

        return $font;
    }

    public function fontFile(): string
    {
        return $this->fontFiles[$this->style];
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

    public function withBrush(Brush $brush): self
    {
        $font = clone $this;
        $font->brush = $brush;

        return $font;
    }

    public function brush(): Brush
    {
        return $this->brush;
    }

    public function withStyle(int $style): self
    {
        $font = clone $this;
        $font->style = $style;

        return $font;
    }

    public function identifier(): Pattern\Identifier
    {
        return Pattern\Identifier::fromString(
            self::class,
            $this->fontFile(),
            $this->size,
            $this->alignment,
            $this->style,
            $this->brush->identifier()
        );
    }

    use Pattern\PrivateConstructor;

    /** @var \SplFixedArray */
    private $fontFiles;
    /** @var float */
    private $size;
    /** @var int */
    private $alignment;
    /** @var Brush */
    private $brush;
    /** @var int */
    private $style;

    private const DEFAULT_FONT_PATH = __DIR__.'/../../assets/fonts/liberation-fonts-ttf-2.00.5/';

    private function checkFontFile(string $fontFile): void
    {
        if (!file_exists($fontFile) || !is_readable($fontFile)) {
            throw new Exception\FontException("Font file [$fontFile] is not readable.");
        }
    }
}
