<?php

require __DIR__.'/../vendor/autoload.php';

use RevealPhp\Adapter;
use RevealPhp\Domain;

$presentation = new Domain\Presentation\SlideShow();
$presentation
    ->addSlide(new Domain\Presentation\Slide\Rectangle(Domain\Geometry\Rect::fromOriginAndSize(
        Domain\Geometry\Point::fromCoordinates(10, 10),
        Domain\Geometry\Size::fromDimensions(100, 100)
    ), Domain\Graphic\ImageFile::fromPath(__DIR__.'/../assets/images/background.jpg')))
    ->addSlide(new Domain\Presentation\Slide\Rectangle(Domain\Geometry\Rect::fromOriginAndSize(
        Domain\Geometry\Point::fromCoordinates(50, 50),
        Domain\Geometry\Size::fromDimensions(100, 200)
    ), Domain\Graphic\ImageFile::fromPath(__DIR__.'/../assets/images/background.jpg')))
;

$engine = new Adapter\Render\SdlEngine();
$drawer = new Adapter\Render\ImagickDrawer();

$engine->start($presentation, $drawer);
