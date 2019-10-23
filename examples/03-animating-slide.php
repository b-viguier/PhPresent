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
    ->addSlide(new class() implements Presentation\Slide {
        public function preload(Presentation\Screen $screen, Graphic\Drawer $drawer, Graphic\Theme $theme): void
        {
            /*
             * This function is called once, when the slideshow is rendered with some new dimensions at screen.
             * You can preload/create some resources if you want to optimize rendering time between each slide.
             * You can safely let this function empty.
             */
        }

        public function render(Presentation\Timestamp $timestamp, Presentation\Screen $screen, Graphic\Drawer $drawer, Graphic\Theme $theme)
        {
            /**
             * This function can also return a *generator* of \PhPresent\Presentation\Frame.
             */

            // Create a \PhPresent\Graphic\Text element that we will be able to position and render.
            $text = $drawer->createText(
                'Hello World',
                // The theme contains a *relative* font,
                // allowing to create a graphical font with a size adapted to current screen resolution.
                $theme->fontH1()->relativeTo($screen->safeArea()->size()->height())
            );

            // Compute the final position of the text
            $textDestination = $text->area()->centeredOn($screen->safeArea()->center());
            // Render the text into a bitmap with text size.
            $bitmap = $drawer->drawText($text)->toBitmap($textDestination->size());

            /**
             * Here the magic! We can yield as many Frame that we want.
             * In return we will retrieve a new timestamp to generate the next frame.
             */
            $spriteAtInitialPosition = Presentation\Sprite::fromBitmap($bitmap);
            $fullMotion = Geometry\Vector::fromPoints($spriteAtInitialPosition->origin(), $textDestination->topLeft());
            $maxTime = 5000/*ms*/;
            while ($timestamp->slideRelative() < $maxTime) {
                $timeRatio = $timestamp->slideRelative() / $maxTime;
                // Create a new sprite, move from original position
                $sprite = $spriteAtInitialPosition->moved(
                    $spriteAtInitialPosition->origin()->movedBy($fullMotion->scaledBy($timeRatio))
                );

                // Yield current frame, and expect the nex timestamp in return.
                $timestamp = yield new Presentation\Frame($sprite);
            }

            return new Presentation\Frame($spriteAtInitialPosition->moved($textDestination->topLeft()));
        }
    })
;

$screen = Presentation\Screen::fromSizeWithExpectedRatio(Geometry\Size::fromDimensions(640, 480));
$engine = new Adapter\SDL\Render\Engine($screen);
$drawer = new Adapter\Imagick\Graphic\Drawer();

$engine->start($presentation, $drawer);
