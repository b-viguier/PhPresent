<?php

require __DIR__.'/../vendor/autoload.php';

use RevealPhp\Adapter;
use RevealPhp\Geometry;
use RevealPhp\Graphic;
use RevealPhp\Presentation;

$presentation = new Presentation\SlideShow(
    Graphic\Theme::createDefault(),
    new Presentation\Template\Simple\FullscreenColor(Graphic\Color::white())
);
$presentation
    ->addSlide(new Presentation\Template\Simple\BigTitle("Hello\nWorld!"))
    ->addSlide(new Presentation\Template\Simple\FullscreenColor(Graphic\Color::black()))
    ->addSlide(new Presentation\Template\Simple\BigTitle("Bye\nWorld!"))
;

$screen = Presentation\Screen::fromSizeWithExpectedRatio(Geometry\Size::fromDimensions(640, 480));
$engine = new Adapter\Render\SdlEngine($screen);
$drawer = new Adapter\Graphic\ImagickDrawer();

$engine->start($presentation, $drawer);
