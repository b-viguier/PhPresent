<?php

require __DIR__.'/../vendor/autoload.php';

use RevealPhp\Adapter;
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

$engine = new Adapter\Render\SdlEngine();
$drawer = new Adapter\Graphic\ImagickDrawer();

$engine->start($presentation, $drawer);
