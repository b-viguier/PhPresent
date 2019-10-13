<?php

namespace PhPresent\Graphic;

use PhPresent\Pattern;

class RelativeFont implements Pattern\Identifiable
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

    public function identifier(): Pattern\Identifier
    {
        return Pattern\Identifier::fromString(
            self::class,
            $this->font->identifier(),
            (string) $this->sizeRatio
        );
    }

    /** @var Font */
    private $font;
    /** @var float */
    private $sizeRatio;
}
