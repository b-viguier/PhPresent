<?php

namespace RevealPhp\Graphic;

use RevealPhp\Pattern;

class Theme
{
    use Pattern\PrivateConstructor;

    public static function createDefault(): self
    {
        return (new self())
            ->withBackgroundColor(Color::RGB(0, 0, 0));
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

    private $bgColor;
}
