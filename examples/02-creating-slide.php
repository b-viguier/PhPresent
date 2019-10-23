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
             * This function has to return a \PhPresent\Presentation\Frame.
             * A frame may be composed of several \PhPresent\Presentation\Sprite.
             * Sprites are created from a \PhPresent\Graphic\Bitmap, and can be moved at a particular position.
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
            // Create a sprite from the bitmap, and move it to the expected position.
            $sprite = Presentation\Sprite::fromBitmap($bitmap)->moved($textDestination->topLeft());

            return new Presentation\Frame($sprite);
        }
    })
;

$screen = Presentation\Screen::fromSizeWithExpectedRatio(Geometry\Size::fromDimensions(640, 480));
$engine = new Adapter\SDL\Render\Engine($screen);
$drawer = new Adapter\Imagick\Graphic\Drawer();

$engine->start($presentation, $drawer);
