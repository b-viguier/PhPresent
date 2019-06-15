<?php

require __DIR__.'/../vendor/autoload.php';

use RevealPhp\Adapter;
use RevealPhp\Graphic;
use RevealPhp\Presentation;

$presentation = new Presentation\SlideShow(Graphic\Theme::createDefault());
$presentation
    ->addSlide(new Presentation\Template\Simple\BigTitle('Hello World'))
    ->addSlide(new Presentation\Template\Simple\FullscreenColor(Graphic\Color::white()))
    ->addSlide(new Presentation\Template\Simple\BigTitle('Bye World'))
;

$engine = new Adapter\Render\SdlEngine();
$drawer = new Adapter\Graphic\ImagickDrawer();

$engine->start($presentation, $drawer);
