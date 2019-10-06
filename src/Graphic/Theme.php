<?php

namespace RevealPhp\Graphic;

use RevealPhp\Pattern;

class Theme implements Pattern\Identifiable
{
    use Pattern\PrivateConstructor;

    public static function createDefault(): self
    {
        $defaultFont = Font::createDefaultSans();
        $defaultBrush = $defaultFont->brush();

        return (new self())
            ->withBackgroundColor(Color::white())
            ->withBrush(Brush::createFrame(Color::black()))
            ->withFontH1(RelativeFont::fromFont(
                $defaultFont->withSize(15),
                100
            ))
            ->withFontH2(RelativeFont::fromFont(
                $defaultFont
                    ->withSize(10)
                    ->withBrush(
                        $defaultBrush
                        ->withFillColor(($h2Color = Color::RGB(100, 100, 100)))
                        ->withStrokeColor($h2Color)
                ),
                100
            ))
            ;
    }

    public function backgroundColor(): Color
    {
        return $this->bgColor;
    }

    public function withBackgroundColor(Color $color): self
    {
        $theme = clone $this;
        $theme->bgColor = $color;

        return $theme;
    }

    public function fontH1(): RelativeFont
    {
        return $this->fontH1;
    }

    public function withFontH1(RelativeFont $font): self
    {
        $theme = clone $this;
        $theme->fontH1 = $font;

        return $theme;
    }

    public function fontH2(): RelativeFont
    {
        return $this->fontH2;
    }

    public function withFontH2(RelativeFont $font): self
    {
        $theme = clone $this;
        $theme->fontH2 = $font;

        return $theme;
    }

    public function brush(): Brush
    {
        return $this->brush;
    }

    public function withBrush(Brush $brush): self
    {
        $theme = clone $this;
        $theme->brush = $brush;

        return $theme;
    }

    public function identifier(): Pattern\Identifier
    {
        return Pattern\Identifier::fromIdentifiable(
            self::class,
            $this->bgColor,
            $this->brush,
            $this->fontH1,
            $this->fontH2
        );
    }

    /** @var Color */
    private $bgColor;
    /** @var RelativeFont */
    private $fontH1;
    /** @var RelativeFont */
    private $fontH2;
    /** @var Brush */
    private $brush;
}
