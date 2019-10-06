<?php

require __DIR__.'/../vendor/autoload.php';

use RevealPhp\Adapter;
use RevealPhp\Geometry;
use RevealPhp\Graphic;
use RevealPhp\Presentation;

$bitmapLoader = new Adapter\Imagick\Graphic\BitmapLoader();

$presentation = new Presentation\SlideShow(
    Graphic\Theme::createDefault(),
    new Presentation\Template\Simple\FullscreenColor(Graphic\Color::white())
);

$presentation
    ->addSlide(new Presentation\Template\Simple\TitleAndSubtitle('RevealPhp', 'A Slideshow tool'))
    ->addSlide(new Presentation\Template\Simple\BigTitle("Hello\nWorld!"))
    ->addSlide(new Presentation\Template\Simple\TitleAndMovingSubtitle('With…', 'Animations!'))
    ->addSlide(new Presentation\Template\Simple\FullscreenImage($bitmapLoader->fromFile(__DIR__.'/../assets/images/background.jpg')))
    ->addSlide(new Presentation\Template\Simple\BigTitle("Bye\nWorld!"))
;

$screen = Presentation\Screen::fromSizeWithExpectedRatio(Geometry\Size::fromDimensions(640, 480));
$engine = new Adapter\SDL\Render\Engine($screen);
$drawer = new Graphic\Drawer\Cache(new Adapter\Imagick\Graphic\Drawer());

$engine->start($presentation, $drawer);
