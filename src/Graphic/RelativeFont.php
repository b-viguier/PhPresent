<?php

namespace RevealPhp\Graphic;

use RevealPhp\Pattern;

class RelativeFont
{
    use Pattern\PrivateConstructor;

    public static function fromFont(Font $font, float $refViewportHeight): self
    {
        $relativeFont = new self();
        $relativeFont->font = $font;
        $relativeFont->sizeRatio = $font->size() / $refViewportHeight;

        return $relativeFont;
    }

    public function relativeTo(float $viewportHeight): Font
    {
        return $this->font->withSize(
            $viewportHeight * $this->sizeRatio
        );
    }

    /** @var Font */
    private $font;
    /** @var float */
    private $sizeRatio;
}
