<?php

namespace RevealPhp\Adapter\Render;

use RevealPhp\Domain;
use RevealPhp\Domain\Geometry;
use RevealPhp\Domain\Graphic;

class ImagickDrawer implements Domain\Render\ResizeableDrawer
{
    public function clear(Geometry\Size $size): Domain\Render\ResizeableDrawer
    {
        $this->size = $size;
        $this->drawer = new \ImagickDraw();
        $this->image = new \Imagick();
        $this->image->newImage($this->size->width(), $this->size->height(), '#f00');
        $this->image->setImageFormat('bmp');

        return $this;
    }

    public function getArea(): Geometry\Rect
    {
        return Geometry\Rect::fromOriginAndSize(
            Geometry\Point::fromCoordinates(0, 0),
            Geometry\Size::fromDimensions($this->size->width() - 1, $this->size->height() - 1)
        );
    }

    public function rectangle(Geometry\Rect $rect, Graphic\Brush $brush): Domain\Render\Drawer
    {
        $this->applyBrush($brush);
        $this->drawer->rectangle($rect->topLeft()->x(), $rect->topLeft()->y(), $rect->bottomRight()->x(), $rect->bottomRight()->y());

        return $this;
    }

    public function text(string $text, Geometry\Point $position, Graphic\Font $font, Graphic\Brush $brush): Domain\Render\Drawer
    {
        $this->applyBrush($brush);

        $this->drawer->setFont($font->fontFile());
        $this->drawer->setFontSize($font->size());

        $this->drawer->annotation((int) $position->x(), (int) $position->y(), $text);

        return $this;
    }

    public function image(Graphic\ImageFile $imageFile, ?Geometry\Rect $src, Geometry\Rect $dst): Domain\Render\Drawer
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

    public function getBmpData(): string
    {
        $this->flushDrawer();

        return $this->image->getImageBlob();
    }

    public function __construct()
    {
        $this->clear(Geometry\Size::fromDimensions(640, 480));
    }

    private function applyBrush(Graphic\Brush $brush): void
    {
        $this->drawer->setStrokeColor($brush->strokeColor()->hex());
        $this->drawer->setFillColor($brush->fillColor()->hex());
        $this->drawer->setStrokeWidth($brush->strokeWidth());
    }

    private function flushDrawer(): void
    {
        $this->image->drawImage($this->drawer);
        $this->drawer->clear();
    }

    /** @var \ImagickDraw */
    private $drawer;
    /** @var \Imagick */
    private $image;
    /** @var Geometry\Size */
    private $size;
}
