<?php

namespace RevealPhp\Graphic;

use RevealPhp\Geometry;

interface Drawer
{
    public function clear(): self;

    public function drawRectangle(Geometry\Rect $rect, Brush $brush): self;

    public function drawText(Text $text): self;

    public function drawImage(ImageFile $imageFile, ?Geometry\Rect $src, Geometry\Rect $dst): self;

    public function createBitmap(Geometry\Size $size): Bitmap;

    public function createText(string $text, Font $font): Text;
}
