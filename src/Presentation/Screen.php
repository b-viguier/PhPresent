<?php

namespace RevealPhp\Presentation;

use RevealPhp\Geometry;
use RevealPhp\Pattern;

class Screen implements Pattern\Identifiable
{
    public static function fromSizeWithExpectedRatio(Geometry\Size $size): self
    {
        $screen = new self();
        $screen->ratio = $size->ratio();
        $screen->fullArea = Geometry\Rect::fromSize($size);
        $screen->safeArea = $screen->fullArea->insideRect($screen->ratio);

        return $screen;
    }

    public function fullArea(): Geometry\Rect
    {
        return $this->fullArea;
    }

    public function safeArea(): Geometry\Rect
    {
        return $this->safeArea;
    }

    public function resized(Geometry\Size $size): self
    {
        $screen = new self();
        $screen->ratio = $this->ratio;
        $screen->fullArea = Geometry\Rect::fromSize($size);
        $screen->safeArea = $screen->fullArea->insideRect($screen->ratio);

        return $screen;
    }

    public function identifier(): Pattern\Identifier
    {
        return Pattern\Identifier::fromIdentifiable(
            self::class,
            $this->fullArea,
            $this->safeArea
        );
    }

    use Pattern\PrivateConstructor;

    /** @var Geometry\Rect */
    private $fullArea;
    /** @var Geometry\Rect */
    private $safeArea;
    /** @var float */
    private $ratio;
}
