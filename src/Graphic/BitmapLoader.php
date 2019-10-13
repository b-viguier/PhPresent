<?php

namespace PhPresent\Graphic;

interface BitmapLoader
{
    public function fromFile(string $filePath): Bitmap;
}
