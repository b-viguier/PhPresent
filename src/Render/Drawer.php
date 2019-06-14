<?php

namespace RevealPhp\Render;

use RevealPhp\Geometry;
use RevealPhp\Graphic;

interface Drawer
{
    public function getArea(): Geometry\Rect;

    public function rectangle(Geometry\Rect $rect, Graphic\Brush $bruch): self;

    public function text(string $text, Geometry\Point $position, Graphic\Font $font, Graphic\Brush $brush): self;

    public function image(Graphic\ImageFile $imageFile, ?Geometry\Rect $src, Geometry\Rect $dst): self;

    public function getBmpData(): string;
}
