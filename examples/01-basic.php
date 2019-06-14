<?php

require __DIR__.'/../vendor/autoload.php';

use RevealPhp\Adapter;
use RevealPhp\Geometry;
use RevealPhp\Graphic;
use RevealPhp\Presentation;

$presentation = new Presentation\SlideShow(Graphic\Theme::createDefault());
$presentation
    ->addSlide(new Presentation\Slide\Rectangle(Geometry\Rect::fromOriginAndSize(
        Geometry\Point::fromCoordinates(10, 10),
        Geometry\Size::fromDimensions(100, 100)
    ), Graphic\ImageFile::fromPath(__DIR__.'/../assets/images/background.jpg')))
    ->addSlide(new Presentation\Slide\Rectangle(Geometry\Rect::fromOriginAndSize(
        Geometry\Point::fromCoordinates(50, 50),
        Geometry\Size::fromDimensions(100, 200)
    ), Graphic\ImageFile::fromPath(__DIR__.'/../assets/images/background.jpg')))
;

$engine = new Adapter\Render\SdlEngine();
$drawer = new Adapter\Render\ImagickDrawer();

$engine->start($presentation, $drawer);
