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

        /** @var ?Graphic\Sprite $helpSprite */
        $helpSprite = null;

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
                            case SDLK_RIGHT:
                                $slideShow->next();
                                break;
                            case SDLK_LEFT:
                                $slideShow->previous();
                                break;
                            case SDLK_q:
                                $quit = true;
                                break;
                            case SDLK_h:
                                if ($helpSprite === null) {
                                    $helpSprite = $this->helpSprite($currentSize, $drawer);
                                } else {
                                    $helpSprite = null;
                                }
                                break;
                        }
                        break;
                }
            }

            //Clear screen
            \SDL_SetRenderDrawColor($this->renderer, 95, 150, 249, 255);
            \SDL_RenderClear($this->renderer);

            $drawer->clear();
            $stack = new Graphic\SpriteStack();
            $stack->push($slideShow->currentSprites($currentSize, $drawer));
            if ($helpSprite !== null) {
                $stack->push($helpSprite);
            }

            /** @var Graphic\Sprite $sprite */
            foreach ($stack->iterate() as $sprite) {
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

    private function helpSprite(Geometry\Size $size, Graphic\Drawer $drawer): Graphic\TraversableSprites
    {
        $drawer->clear();

        return Graphic\Sprite::fromBitmap(
            $drawer->drawRectangle(
                $screenArea = Geometry\Rect::fromSize($size),
                Graphic\Brush::createDefault()
                    ->withFillColor(Graphic\Color::RGB(10, 10, 10, 220))
            )->drawText(
                "Help\nq : Quit\n->/space : Next\n<- : Previous",
                $screenArea->center(),
                Graphic\Font::createDefault()->withAlignment(Graphic\Font::ALIGN_CENTER),
                Graphic\Brush::createDefault()
                    ->withStrokeColor(Graphic\Color::RGB(250, 220, 0))
            )->createBitmap($size),
            Geometry\Point::origin()
        );
    }

    /** @var \SDL_Window */
    private $window;
    private $renderer;
}
