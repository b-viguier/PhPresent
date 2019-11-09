<?php

namespace PhPresent\Adapter\SDL\Render;

use PhPresent\Geometry;
use PhPresent\Graphic;
use PhPresent\Presentation;
use PhPresent\Render;

class Engine implements Render\Engine
{
    public function __construct(Presentation\Screen $screen)
    {
        \SDL_Init(SDL_INIT_VIDEO);
        $this->window = \SDL_CreateWindow(
            'PhPresent',
            SDL_WINDOWPOS_UNDEFINED, SDL_WINDOWPOS_UNDEFINED,
            $screen->fullArea()->size()->width(), $screen->fullArea()->size()->height(),
            SDL_WINDOW_SHOWN | SDL_WINDOW_RESIZABLE | SDL_WINDOW_ALLOW_HIGHDPI
        );
        $this->renderer = \SDL_CreateRenderer($this->window, -1, 0);
        $w = $h = 0;
        \SDL_GetRendererOutputSize($this->renderer, $w, $h);
        $this->screen = Presentation\Screen::fromSizeWithExpectedRatio(
            Geometry\Size::fromDimensions($w, $h)
        );

        // Rendering runs at 60FPS
        $this->frameRateLimiter = new FrameRateLimiter(60);
    }

    public function start(Presentation\SlideShow $slideShow, Graphic\Drawer $drawer)
    {
        // Events data
        $quit = false;
        $event = new \SDL_Event();

        /** @var ?Presentation\Sprite $helpSprite */
        $helpSprite = null;

        $textureLoader = new TextureLoader\Sprite();
        $textureRenderers = [
            new TextureRenderer\SdlRender(),
            new TextureRenderer\Debug(new TextureRenderer\SdlRender()),
            new TextureRenderer\Debug(new TextureRenderer\NoOp()),
        ];

        $dbgTextRenderer = DbgTextRenderer::create($this->renderer);
        $postRenderers = [
            new PostRenderer\NoOp(),
            new PostRenderer\Stack(
                new PostRenderer\SafeZone(),
                new PostRenderer\Statistics($dbgTextRenderer)
            ),
        ];

        $this->preload($dbgTextRenderer, $slideShow, $drawer);
        while (!$quit) {
            $this->frameRateLimiter->renderingStarts();

            // Inputs polling
            while (sdl_pollevent($event) !== 0) {
                switch ($event->type) {
                    case SDL_QUIT:
                        $quit = true;
                        break;
                    case SDL_WINDOWEVENT:
                        if ($event->window->event === SDL_WINDOWEVENT_RESIZED) {
                            $this->preload($dbgTextRenderer, $slideShow, $drawer);
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
                                    $helpSprite = $this->helpSprite($drawer);
                                } else {
                                    $helpSprite = null;
                                }
                                break;
                            case SDLK_d:
                                end($postRenderers);
                                if (false === next($textureRenderers)) {
                                    reset($textureRenderers);
                                    reset($postRenderers);
                                }
                                break;
                        }
                        break;
                }
            }

            //Clear screen
            \SDL_SetRenderDrawColor($this->renderer, 95, 150, 249, 255);
            \SDL_RenderClear($this->renderer);

            $frame = $slideShow->currentFrame($this->screen, $drawer);
            if ($helpSprite !== null) {
                $frame = $frame->withPushedSprites($helpSprite);
            }

            \SDL_SetRenderDrawColor($this->renderer, 255, 0, 0, 255);
            /** @var Presentation\Sprite $sprite */
            foreach ($frame->sprites() as $sprite) {
                current($textureRenderers)->render(
                    $this->renderer,
                    $textureLoader->load($this->renderer, $sprite)
                );
            }

            current($postRenderers)->render($this->renderer, $this->screen);

            // Screen refresh
            \SDL_RenderPresent($this->renderer);
            $this->frameRateLimiter->pause();
        }
        echo PHP_EOL;
    }

    private function preload(DbgTextRenderer $textRenderer, Presentation\SlideShow $slideShow, Graphic\Drawer $drawer): void
    {
        reload:

        $w = $h = 0;
        \SDL_GetRendererOutputSize($this->renderer, $w, $h);
        $this->screen = $this->screen->resized(
            Geometry\Size::fromDimensions($w, $h)
        );

        $progress = $slideShow->preload($this->screen, $drawer);

        $size = (int) ($this->screen->safeArea()->size()->height() / 30);
        $event = new \SDL_Event();
        $current = $progress->advance();
        while ($current < $progress->count()) {
            $this->frameRateLimiter->renderingStarts();

            // Inputs polling
            while (sdl_pollevent($event) !== 0) {
                if ($event->type === SDL_WINDOWEVENT && $event->window->event === SDL_WINDOWEVENT_RESIZED) {
                    goto reload; // Avoid nesting function calls
                }
            }

            //Clear screen
            \SDL_SetRenderDrawColor($this->renderer, 0, 0, 0, 0);
            \SDL_RenderClear($this->renderer);

            $textRenderer->render(
                $this->renderer,
                "LOADING: $current / ".$progress->count(),
                $this->screen->fullArea()->topLeft(),
                $size
            );

            // Screen refresh
            \SDL_RenderPresent($this->renderer);
            $this->frameRateLimiter->pause();

            $current = $progress->advance();
        }
    }

    private function helpSprite(Graphic\Drawer $drawer): Presentation\TraversableSprites
    {
        $drawer->clear();

        return Presentation\Sprite::fromBitmap(
            $drawer->drawRectangle(
                Geometry\Rect::fromSize($this->screen->safeArea()->size()),
                Graphic\Brush::createFilled(Graphic\Color::RGB(10, 10, 10, 220))
            )->drawText(
                $drawer->createText(
                    "Help\nq : Quit\n->/space : Next\n<- : Previous\nd : Toggle Debug",
                    Graphic\Font::createDefaultMono()
                        ->withAlignment(Graphic\Font::ALIGN_CENTER)
                        ->withBrush(Graphic\Brush::createFilled(Graphic\Color::RGB(250, 220, 0)))
                )
            )->toBitmap($this->screen->safeArea()->size())
        )->moved($this->screen->safeArea()->topLeft());
    }

    /** @var \SDL_Window */
    private $window;
    private $renderer;
    /** @var Presentation\Screen */
    private $screen;
    /** @var FrameRateLimiter */
    private $frameRateLimiter;
}
