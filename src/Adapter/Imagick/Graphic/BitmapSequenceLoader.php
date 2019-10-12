<?php

namespace RevealPhp\Adapter\Imagick\Graphic;

use RevealPhp\Geometry;
use RevealPhp\Graphic;

class BitmapSequenceLoader implements \RevealPhp\Graphic\BitmapSequenceLoader
{
    public function fromFile(string $filePath): Graphic\BitmapSequence
    {
        try {
            $animation = new \Imagick($filePath);
            $frames = [];

            foreach ($animation as $_) {
                $frames[] = new Graphic\BitmapSequenceFrame(
                    $animation->getImageBlob(),
                    $animation->getImageDelay() * 10 //centi-seconds to milli-seconds
                );
            }

            return Graphic\BitmapSequence::fromFrames(
                Geometry\Size::fromDimensions(
                    $animation->getImageWidth(),
                    $animation->getImageHeight()
                ),
                ...$frames
            );
        } catch (\Throwable $throwable) {
            throw new Graphic\Exception\BitmapLoaderException(
                "Unable to load [$filePath] bitmap sequence",
                0,
                $throwable
            );
        }
    }
}
