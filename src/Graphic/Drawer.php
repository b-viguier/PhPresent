<?php

namespace PhPresent\Graphic;

use PhPresent\Geometry;
use PhPresent\Pattern;

interface Drawer extends Pattern\MetricProducer
{
    public function clear(): self;

    public function drawRectangle(Geometry\Rect $rect, Brush $brush): self;

    public function drawText(Text $text): self;

    public function drawBitmap(Bitmap $bitmap, Geometry\Rect $src, Geometry\Rect $dst): self;

    public function toBitmap(Geometry\Size $size): Bitmap;

    public function createText(string $text, Font $font): Text;
}
