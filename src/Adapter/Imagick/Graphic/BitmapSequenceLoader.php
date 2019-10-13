<?php

namespace PhPresent\Adapter\Imagick\Graphic;

use PhPresent\Geometry;
use PhPresent\Graphic;

class BitmapSequenceLoader implements \PhPresent\Graphic\BitmapSequenceLoader
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
