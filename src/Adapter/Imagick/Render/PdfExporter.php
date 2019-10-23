<?php

namespace PhPresent\Adapter\Imagick\Render;

use PhPresent\Geometry;
use PhPresent\Graphic;
use PhPresent\Presentation;

class PdfExporter
{
    public function export(Presentation\SlideShow $slideShow, Presentation\Screen $screen, Graphic\Drawer $drawer, string $filepath): void
    {
        $progress = $slideShow->preload($screen, $drawer);
        $count = $progress->count();
        while (($current = $progress->advance()) < $count) {
            echo "Loading\t$current / $count\r";
        }
        echo PHP_EOL;

        $pdf = null;
        echo $current = 0;
        do {
            echo "Generating\t{$current}  \r";
            ++$current;

            $frame = $slideShow->currentFrame($screen, $drawer);
            $hasNextSlide = !$slideShow->isLastSlide();

            $drawer->clear();
            /** @var Presentation\Sprite $sprite */
            foreach ($frame->sprites() as $sprite) {
                $drawer->drawBitmap(
                    $sprite->bitmap(),
                    Geometry\Rect::fromSize($sprite->bitmap()->size()),
                    Geometry\Rect::fromTopLeftAndSize(
                        $sprite->origin(),
                        $sprite->size()
                    )
                );
            }
            $finalBitmap = $drawer->toBitmap($screen->fullArea()->size());
            $currentImage = new \Imagick();
            $currentImage->readImageBlob($finalBitmap->content());

            if ($pdf) {
                $pdf->addImage($currentImage);
            } else {
                $pdf = $currentImage;
            }

            $slideShow->next();
        } while ($hasNextSlide);

        echo "\nWriting [$filepath]\n";
        $pdf->setImageFormat('pdf');
        $pdf->writeImages($filepath, true);
    }
}
