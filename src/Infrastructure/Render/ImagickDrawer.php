<?php

namespace RevealPhp\Infrastructure\Render;

use RevealPhp\Domain;
use RevealPhp\Domain\Geometry;
use RevealPhp\Domain\Graphic;

class ImagickDrawer implements Domain\Render\ResizeableDrawer
{
    public function clear(): Domain\Render\Drawer
    {
        $this->drawer = new \ImagickDraw();

        return $this;
    }

    public function setSize(Geometry\Size $size): void
    {
        $this->size = $size;
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

    public function getBmpData(): string
    {
        $image = new \Imagick();
        $image->newImage($this->size->width(), $this->size->height(), '#f00');
        $image->setImageFormat('bmp');
        $image->drawImage($this->drawer);

        return $image->getImageBlob();
    }

    public function __construct()
    {
        $this->size = Geometry\Size::fromDimensions(640, 480);
        $this->clear();
    }

    private function applyBrush(Graphic\Brush $brush): void
    {
        $this->drawer->setStrokeColor($brush->strokeColor()->hex());
        $this->drawer->setFillColor($brush->fillColor()->hex());
        $this->drawer->setStrokeWidth($brush->strokeWidth());
    }

    /** @var \ImagickDraw */
    private $drawer;
    /** @var Geometry\Size */
    private $size;
}
