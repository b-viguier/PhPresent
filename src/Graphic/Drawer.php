<?php

namespace RevealPhp\Graphic;

use RevealPhp\Geometry;

interface Drawer
{
    public function clear(): self;

    public function drawRectangle(Geometry\Rect $rect, Brush $brush): self;

    public function drawText(string $text, Geometry\Point $topLeft, Font $font): self;

    public function drawImage(ImageFile $imageFile, ?Geometry\Rect $src, Geometry\Rect $dst): self;

    public function createBitmap(Geometry\Size $size): Bitmap;

    public function textDimensions(string $text, Font $font): Geometry\Size;
}
