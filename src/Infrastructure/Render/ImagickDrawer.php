<?php

namespace RevealPhp\Infrastructure\Render;

use RevealPhp\Domain;

class ImagickDrawer implements Domain\Render\ResizeableDrawer
{
    public function clear(): Domain\Render\Drawer
    {
        $this->drawer = new \ImagickDraw();

        // Global initialization
        $this->drawer->setStrokeColor('#000');
        $this->drawer->setFillColor('#fff');
        $this->drawer->setStrokeOpacity(1);
        $this->drawer->setStrokeWidth(2);

        return $this;
    }

    public function setSize(Domain\Geometry\Size $size)
    {
        $this->size = $size;
    }

    public function rectangle(Domain\Geometry\Rect $rect): Domain\Render\Drawer
    {
        $this->drawer->rectangle($rect->topLeft()->x(), $rect->topLeft()->y(), $rect->bottomRight()->x(), $rect->bottomRight()->y());

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
        $this->size = Domain\Geometry\Size::fromDimensions(640, 480);
        $this->clear();
    }

    /** @var \ImagickDraw */
    private $drawer;
    /** @var Domain\Geometry\Size */
    private $size;
}
