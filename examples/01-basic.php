<?php

require __DIR__.'/../vendor/autoload.php';

use RevealPhp\Domain;
use RevealPhp\Infrastructure;

$presentation = new Domain\Presentation\SlideShow();
$presentation
    ->addSlide(new Domain\Presentation\Slide\Rectangle(Domain\Geometry\Rect::fromOriginAndSize(
        Domain\Geometry\Point::fromCoordinates(10, 10),
        Domain\Geometry\Size::fromDimensions(100, 100)
    )))
    ->addSlide(new Domain\Presentation\Slide\Rectangle(Domain\Geometry\Rect::fromOriginAndSize(
        Domain\Geometry\Point::fromCoordinates(50, 50),
        Domain\Geometry\Size::fromDimensions(100, 200)
    )))
;

$engine = new Infrastructure\Render\SdlEngine();
$imagine = new Imagine\Imagick\Imagine();

$engine->start($presentation, $imagine);
