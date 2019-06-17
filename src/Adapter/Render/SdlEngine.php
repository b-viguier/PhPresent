<?php

namespace RevealPhp\Adapter\Render;

use RevealPhp\Geometry;
use RevealPhp\Graphic;
use RevealPhp\Presentation;
use RevealPhp\Render;

class SdlEngine implements Render\Engine
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

    public function start(Presentation\SlideShow $slideShow, Graphic\Drawer $drawer)
    {
        // Events data
        $quit = false;
        $event = new \SDL_Event();
        $currentSize = Geometry\Size::fromDimensions(640, 480);

        while (!$quit) {
            // Inputs polling
            while (sdl_pollevent($event) !== 0) {
                switch ($event->type) {
                    case SDL_QUIT:
                        $quit = true;
                        break;
                    case SDL_WINDOWEVENT:
                        if ($event->window->event === SDL_WINDOWEVENT_RESIZED) {
                            $currentSize = Geometry\Size::fromDimensions($event->window->data1, $event->window->data2);
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

            $drawer->clear();
            $sprites = $slideShow->currentSprites($currentSize, $drawer);
            /** @var Graphic\Sprite $sprite */
            foreach ($sprites->iterate() as $sprite) {
                $image = $sprite->bitmap()->content();
                $stream = \SDL_RWFromConstMem($image, strlen($image));
                unset($image);
                $surface = \SDL_LoadBMP_RW($stream, 1/*free*/);
                $texture = \SDL_CreateTextureFromSurface($this->renderer, $surface);
                \SDL_FreeSurface($surface);

                $dstRect = new \SDL_Rect(
                    (int) $sprite->position()->x(),
                    (int) $sprite->position()->y(),
                    (int) $sprite->bitmap()->size()->width(),
                    (int) $sprite->bitmap()->size()->height()
                );

                \SDL_RenderCopy(
                    $this->renderer,
                    $texture,
                    null,
                    $dstRect
                );
            }

            // Screen refresh
            \SDL_RenderPresent($this->renderer);
            \SDL_Delay(10);
        }
        echo PHP_EOL;
    }

    private $window;
    private $renderer;
}
