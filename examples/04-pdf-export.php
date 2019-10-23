<?php

require __DIR__.'/../vendor/autoload.php';

use PhPresent\Adapter;
use PhPresent\Geometry;
use PhPresent\Graphic;
use PhPresent\Presentation;

$bitmapLoader = new Adapter\Imagick\Graphic\BitmapLoader();
$bitmapSequenceLoader = new Adapter\Imagick\Graphic\BitmapSequenceLoader();

$presentation = new Presentation\SlideShow(
    Graphic\Theme::createDefault(),
    new Presentation\Template\Simple\FullscreenColor(Graphic\Color::white())
);

$presentation
    ->addSlide(new Presentation\Template\Simple\TitleAndSubtitle(
        'PhPresent', 'A Slideshow tool'
    ))
    ->addSlide(new Presentation\Template\Simple\FullscreenAnimatedImage(
        $bitmapSequenceLoader->fromFile(__DIR__.'/../assets/images/whirlyGif.gif')
    ))
    ->addSlide(new Presentation\Template\Simple\BigTitle(
        "Hello\nWorld!"
    ))
    ->addSlide(new Presentation\Template\Simple\TitleAndMovingSubtitle(
        'With…', 'Animations!'
    ))
    ->addSlide(new Presentation\Template\Simple\FullscreenImage(
        $bitmapLoader->fromFile(__DIR__.'/../assets/images/background.jpg')
    ))
    ->addSlide(new Presentation\Template\Simple\BigTitle("Bye\nWorld!"))
;

$screen = Presentation\Screen::fromSizeWithExpectedRatio(Geometry\Size::fromDimensions(1280, 960));
$drawer = new Adapter\Imagick\Graphic\Drawer();

// Do not render the presentation, but export it
$pdfExporter = new Adapter\Imagick\Render\PdfExporter();

$pdfExporter->export($presentation, $screen, $drawer, __DIR__.'/../test.pdf');
