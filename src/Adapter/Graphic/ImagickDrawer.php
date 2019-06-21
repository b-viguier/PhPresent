<?php

namespace RevealPhp\Adapter\Graphic;

use RevealPhp\Geometry;
use RevealPhp\Graphic;

class ImagickDrawer implements Graphic\Drawer
{
    public function clear(): Graphic\Drawer
    {
        $this->drawer = new \ImagickDraw();
        $this->image = new \Imagick();

        $this->drawer->setTextAntialias(true);
        $this->drawer->setStrokeAntialias(true);

        return $this;
    }

    public function drawRectangle(Geometry\Rect $rect, Graphic\Brush $brush): Graphic\Drawer
    {
        $this->applyBrush($brush);
        $this->drawer->rectangle($rect->topLeft()->x(), $rect->topLeft()->y(), $rect->bottomRight()->x(), $rect->bottomRight()->y());

        return $this;
    }

    public function drawText(Graphic\Text $text): Graphic\Drawer
    {
        $this->applyFont($text->font());
        $this->applyBrush($text->font()->brush());

        $this->drawer->annotation((int) $text->refPoint()->x(), (int) $text->refPoint()->y(), $text->content());

        return $this;
    }

    public function createText(string $text, Graphic\Font $font): Graphic\Text
    {
        $this->drawer->push();
        $this->applyFont($font);
        $metrics = $this->image->queryFontMetrics($this->drawer, $text);
        $this->drawer->pop();

        return new class($text, $font, $metrics) extends Graphic\Text {
            public function __construct(string $text, Graphic\Font $font, array $metrics)
            {
                // Assuming topLeft is on (0,0), where should text be traced?
                switch ($font->alignment()) {
                    case Graphic\Font::ALIGN_LEFT:
                        $textPosition = Geometry\Point::fromCoordinates(
                            0,
                            $metrics['ascender']
                        );
                        break;
                    case Graphic\Font::ALIGN_CENTER:
                        $textPosition = Geometry\Point::fromCoordinates(
                            $metrics['textWidth'] / 2,
                            $metrics['ascender']
                        );
                        break;
                    case Graphic\Font::ALIGN_RIGHT:
                        $textPosition = Geometry\Point::fromCoordinates(
                            $metrics['textWidth'],
                            $metrics['ascender']
                        );
                        break;
                    default:
                        $textPosition = Geometry\Point::origin();
                }

                parent::__construct(
                    $text,
                    $font,
                    Geometry\Rect::fromSize(
                        Geometry\Size::fromDimensions($metrics['textWidth'], $metrics['textHeight'])
                    ),
                    $textPosition
                );
            }
        };
    }

    public function drawImage(Graphic\ImageFile $imageFile, ?Geometry\Rect $src, Geometry\Rect $dst): Graphic\Drawer
    {
        $image = new \Imagick($imageFile->path());
        if ($src !== null) {
            $image->cropImage($src->size()->width(), $src->size()->height(), $src->topLeft()->x(), $src->topLeft()->y());
        }
        $image->resizeImage($dst->size()->width(), $dst->size()->height(), \Imagick::FILTER_GAUSSIAN, false);

        $this->drawer->composite(
            \Imagick::COMPOSITE_OVER,
            $dst->topLeft()->x(),
            $dst->topLeft()->y(),
            $dst->size()->width(),
            $dst->size()->height(),
            $image
        );

        return $this;
    }

    public function createBitmap(Geometry\Size $size): Graphic\Bitmap
    {
        $this->image->newImage($size->width(), $size->height(), '#0000');
        $this->image->setImageFormat('bmp');

        $this->image->drawImage($this->drawer);

        return Graphic\Bitmap::fromBmpContent(
            $this->image->getImageBlob(),
            $size
        );
    }

    public function __construct()
    {
        $this->clear();
    }

    private function applyBrush(Graphic\Brush $brush): void
    {
        $this->drawer->setStrokeColor($brush->strokeColor()->hex());
        $this->drawer->setFillColor($brush->fillColor()->hex());
        $this->drawer->setStrokeWidth($brush->strokeWidth());
    }

    private function applyFont(Graphic\Font $font): void
    {
        $this->drawer->setFont($font->fontFile());
        $this->drawer->setFontSize($font->size());
        $this->drawer->setTextAlignment($this->imagickAlignment($font));
    }

    private function imagickAlignment(Graphic\Font $font): int
    {
        switch ($font->alignment()) {
            case Graphic\Font::ALIGN_LEFT:
                return \Imagick::ALIGN_LEFT;
            case Graphic\Font::ALIGN_RIGHT:
                return \Imagick::ALIGN_RIGHT;
            case Graphic\Font::ALIGN_CENTER:
                return \Imagick::ALIGN_CENTER;
        }

        return \Imagick::ALIGN_CENTER;
    }

    /** @var \ImagickDraw */
    private $drawer;
    /** @var \Imagick */
    private $image;
}
