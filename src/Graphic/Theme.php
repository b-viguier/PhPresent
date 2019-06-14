<?php

namespace RevealPhp\Graphic;

use RevealPhp\Pattern;

class Theme
{
    use Pattern\PrivateConstructor;

    public static function createDefault(): self
    {
        return (new self())
            ->withBackgroundColor(Color::black())
            ->withFont(Font::createDefault())
            ->withBrush(Brush::createDefault())
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

    public function font(): Font
    {
        return $this->font;
    }

    public function withFont(Font $font): self
    {
        $theme = clone $this;
        $theme->font = $font;

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

    /** @var Color */
    private $bgColor;
    /** @var Font */
    private $font;
    /** @var Brush */
    private $brush;
}
