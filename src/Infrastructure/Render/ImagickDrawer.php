<?php

namespace RevealPhp\Infrastructure\Render;

use RevealPhp\Domain;
use RevealPhp\Domain\Geometry;

class ImagickDrawer implements Domain\Render\Drawer
{
    public function clear(): Domain\Render\Drawer
    {
        $this->__construct();

        return $this;
    }

    public function rectangle(Geometry\Rect $rect): Domain\Render\Drawer
    {
        $this->drawer->rectangle($rect->topLeft()->x(), $rect->topLeft()->y(), $rect->bottomRight()->x(), $rect->bottomRight()->y());

        return $this;
    }

    public function getBmpData(): string
    {
        $image = new \Imagick();
        $image->newImage(500, 500, '#f00');
        $image->setImageFormat('bmp');
        $image->drawImage($this->drawer);

        return $image->getImageBlob();
    }

    public function __construct()
    {
        $this->drawer = new \ImagickDraw();

        // Global initialization
        $this->drawer->setStrokeColor('#000');
        $this->drawer->setFillColor('#fff');
        $this->drawer->setStrokeOpacity(1);
        $this->drawer->setStrokeWidth(2);
    }

    /** @var \ImagickDraw */
    private $drawer;
}
