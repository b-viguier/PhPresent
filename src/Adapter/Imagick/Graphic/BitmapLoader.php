<?php

namespace RevealPhp\Adapter\Imagick\Graphic;

use RevealPhp\Geometry;
use RevealPhp\Graphic;

class BitmapLoader implements \RevealPhp\Graphic\BitmapLoader
{
    public function fromFile(string $filePath): Graphic\Bitmap
    {
        try {
            $image = new \Imagick($filePath);

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
