<?php

namespace RevealPhp\Graphic;

interface BitmapLoader
{
    public function fromFile(string $filePath): Bitmap;
}
