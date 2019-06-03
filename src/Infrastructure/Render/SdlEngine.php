<?php

namespace RevealPhp\Infrastructure\Render;

use Imagine\Image\Box;
use Imagine\Image\ImagineInterface;
use RevealPhp\Domain;

class SdlEngine implements Domain\Render\Engine
{
    public function __construct()
    {
        \SDL_Init(SDL_INIT_VIDEO);
        $this->window = \SDL_CreateWindow(
            'RevealPhp',
            SDL_WINDOWPOS_UNDEFINED, SDL_WINDOWPOS_UNDEFINED,
            640, 480,
            SDL_WINDOW_SHOWN | SDL_WINDOW_RESIZABLE
        );
        $this->renderer = \SDL_CreateRenderer($this->window, -1, 0);
    }

    public function start(Domain\Presentation\SlideShow $slideShow, ImagineInterface $imagine)
    {
        // Events data
        $quit = false;
        $event = new \SDL_Event();

        // Image initialization
        $palette = new \Imagine\Image\Palette\RGB();
        $width = $height = 1;
        $this->window->getSize($width, $height);

        while (!$quit) {
            // Inputs polling
            while (sdl_pollevent($event) !== 0) {
                switch ($event->type) {
                    case SDL_QUIT:
                        $quit = true;
                        break;
                    case SDL_WINDOWEVENT:
                        if ($event->window->event === SDL_WINDOWEVENT_RESIZED) {
                            $width = $event->window->data1;
                            $height = $event->window->data2;
                        }
                        break;
                    case SDL_KEYDOWN:
                        switch ($event->key->keysym->sym) {
                            case SDLK_SPACE:
                                $slideShow->next();
                                break;
                        }
                        break;
                }
            }

            if ($slideShow->isFinished()) {
                break;
            }

            //Clear screen
            \SDL_SetRenderDrawColor($this->renderer, 95, 150, 249, 255);
            \SDL_RenderClear($this->renderer);

            // Clear image
            $image = $imagine->create(new Box($width, $height), $palette->color('#000'));

            // Rendering
            $slideShow->currentImage($image->draw(), $image->getSize(), $image->palette());
            $binaryImage = $image->get('bmp');
            $stream = \SDL_RWFromConstMem($binaryImage, strlen($binaryImage));
            unset($binaryImage);
            $surface = \SDL_LoadBMP_RW($stream, 1/*free*/);
            $texture = \SDL_CreateTextureFromSurface($this->renderer, $surface);
            \SDL_FreeSurface($surface);

            \SDL_RenderCopy(
                $this->renderer,
                $texture,
                null,
                null
            );

            // Screen refresh
            \SDL_RenderPresent($this->renderer);
            \SDL_Delay(10);
        }
        echo PHP_EOL;
    }

    private $window;
    private $renderer;
}
