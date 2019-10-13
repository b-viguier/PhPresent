<?php

namespace PhPresent\Adapter\Imagick\Graphic;

use PhPresent\Geometry;
use PhPresent\Graphic;

class Drawer implements Graphic\Drawer
{
    public function clear(): Graphic\Drawer
    {
        try {
            $this->drawer = new \ImagickDraw();
            $this->image = new \Imagick();

            $this->drawer->setTextAntialias(true);
            $this->drawer->setStrokeAntialias(true);

            return $this;
        } catch (\Throwable $throwable) {
            throw new Graphic\Exception\DrawerException('Failed to clear drawer', 0, $throwable);
        }
    }

    public function drawRectangle(Geometry\Rect $rect, Graphic\Brush $brush): Graphic\Drawer
    {
        try {
            $this->applyBrush($brush);
            $this->drawer->rectangle((int) $rect->topLeft()->x(), (int) $rect->topLeft()->y(), (int) $rect->bottomRight()->x(), (int) $rect->bottomRight()->y());

            return $this;
        } catch (\Throwable $throwable) {
            throw new Graphic\Exception\DrawerException('Failed to draw rectangle', 0, $throwable);
        }
    }

    public function drawText(Graphic\Text $text): Graphic\Drawer
    {
        try {
            $this->applyFont($text->font());
            $this->applyBrush($text->font()->brush());
            $this->drawer->annotation((int) $text->refPoint()->x(), (int) $text->refPoint()->y(), $text->content());

            return $this;
        } catch (\Throwable $throwable) {
            throw new Graphic\Exception\DrawerException('Failed to draw text', 0, $throwable);
        }
    }

    public function createText(string $text, Graphic\Font $font): Graphic\Text
    {
        try {
            $this->drawer->push();
            $this->applyFont($font);
            $metrics = $this->image->queryFontMetrics($this->drawer, $text);
            $this->drawer->pop();

            return new Text($text, $font, $metrics);
        } catch (\Throwable $throwable) {
            throw new Graphic\Exception\DrawerException('Failed to create text', 0, $throwable);
        }
    }

    public function drawBitmap(Graphic\Bitmap $bitmap, Geometry\Rect $src, Geometry\Rect $dst): Graphic\Drawer
    {
        try {
            $image = new \Imagick();
            $image->readImageBlob($bitmap->content());
            $image->cropImage($src->size()->width(), $src->size()->height(), $src->topLeft()->x(), $src->topLeft()->y());
            $this->drawer->composite(
                \Imagick::COMPOSITE_OVER,
                (int) $dst->topLeft()->x(),
                (int) $dst->topLeft()->y(),
                (int) $dst->size()->width(),
                (int) $dst->size()->height(),
                $image
            );

            return $this;
        } catch (\Throwable $throwable) {
            throw new Graphic\Exception\DrawerException('Failed to draw bitmap', 0, $throwable);
        }
    }

    public function toBitmap(Geometry\Size $size): Graphic\Bitmap
    {
        try {
            $this->image->newImage((int) $size->width(), (int) $size->height(), '#0000');
            $this->image->setImageFormat('bmp');
            $this->image->drawImage($this->drawer);

            return Graphic\Bitmap::fromBmpContent(
                $this->image->getImageBlob(),
                $size
            );
        } catch (\Throwable $throwable) {
            throw new Graphic\Exception\DrawerException('Failed to convert to bitmap', 0, $throwable);
        }
    }

    public function allMetrics(): iterable
    {
        return;
        yield;
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
        $this->drawer->setFontSize((int) $font->size());
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
