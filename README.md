# PhPresent

_PhPresent_ is a library allowing to create a slideshow program in Php,
in the same way that [RevealJs](https://revealjs.com) for Javascript.
It is possible thanks to the [Php-SDL extension](https://github.com/Ponup/php-sdl) and
[Imagick extension](https://www.php.net/manual/en/book.imagick.php).

:warning: This library is freshly new,
it mays not work as expected in your particular environment.
Give it a try, and feel free to give some feedback about it.  

## Installation

Be sure to have required extensions:
* [Php-SDL](https://pecl.php.net/package/sdl)
* [Imagick](https://pecl.php.net/package/imagick)

:warning: Sometimes, we may need some features of `Php-SDL` not released yet.
Be aware that some versions might need to compile the extension directly from the sources.

The create your project and install this library through [Composer](https://getcomposer.org/).
```bash
composer require bviguier/phpresent
```

## Usage
ℹ️ Have a look to the `examples` directory to quickly check that all is working fine for you.
When your program is running, press `h` to obtain some help about available commands. 

### Bootstrapping your presentation

```php
<?php

require __DIR__.'/../vendor/autoload.php';

// Contains specific implementation.
use PhPresent\Adapter;
// All stuff related to mathematics.
use PhPresent\Geometry;
// Here we speak about bitmaps, colours, fonts…
use PhPresent\Graphic;
// The heart of the matter, the tools to create a presentation.
use PhPresent\Presentation;

/**
* You need 2 things to create a slideshow:
*  * A theme, to share some graphic expectations between slides (fonts, colors…)
*  * A background slide, that will be displayed… in the background!
*/ 
$presentation = new Presentation\SlideShow(
    Graphic\Theme::createDefault(),
    new Presentation\Template\Simple\FullscreenColor(Graphic\Color::white())
);

// Here, we will have to insert some slides (see next step)

/**
* The Screen class gives information about the rendering area.
* Although the window will be resizeable, this initial screen ratio will be used to define the *safe* zone.
* The safe zone is the larger available area in the screen with the expected size ratio.
* It will guarantee the final rendering of your slides whatever the actual screen size. 
*/ 
$screen = Presentation\Screen::fromSizeWithExpectedRatio(Geometry\Size::fromDimensions(640, 480));

/**
* The engine that will render your presentation, thanks to SDL extension.
*/
$engine = new Adapter\SDL\Render\Engine($screen);

/**
* The drawer let you create complex images or texts.
* Current implementation uses Imagick extension.
*/
$drawer = new Adapter\Imagick\Graphic\Drawer();

// Let's start the show!
$engine->start($presentation, $drawer);
``` 

### Using existing slides templates
Some templates are provided in the `PhPresent\Presentation\Template\Simple` namespace.

```php
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
;
```


### Creating your own slides templates
Provided templates are very generic, and you may quickly want to create your own.
Check [`02-creating-slide.php` example](/examples/02-creating-slide.php) to see how it works.
 
### Creating animated slides
Here the funny part!
Have a look to [`03-animating-slide.php` example](/examples/03-animating-slide.php) for more details.
