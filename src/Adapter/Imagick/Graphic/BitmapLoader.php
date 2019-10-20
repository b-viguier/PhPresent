<?php

namespace PhPresent\Adapter\Imagick\Graphic;

use PhPresent\Geometry;
use PhPresent\Graphic;

class BitmapLoader implements \PhPresent\Graphic\BitmapLoader
{
    public function fromFile(string $filePath): Graphic\Bitmap
    {
        try {
            $image = new \Imagick($filePath);
            $image->setFormat('bmp');

            return Graphic\Bitmap::fromBmpContent(
                $image->getImageBlob(),
                Geometry\Size::fromDimensions(
                    $image->getImageWidth(),
                    $image->getImageHeight()
                )
            );
        } catch (\Throwable $throwable) {
            throw new Graphic\Exception\BitmapLoaderException("Unable to load [$filePath] bitmap", 0, $throwable);
        }
    }
}
