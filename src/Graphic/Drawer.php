<?php

namespace RevealPhp\Graphic;

use RevealPhp\Geometry;

interface Drawer
{
    public function getArea(): Geometry\Rect;

    public function rectangle(Geometry\Rect $rect, Brush $bruch): self;

    public function text(string $text, Geometry\Point $position, Font $font, Brush $brush): self;

    public function image(ImageFile $imageFile, ?Geometry\Rect $src, Geometry\Rect $dst): self;

    public function getBmpData(): string;
}
