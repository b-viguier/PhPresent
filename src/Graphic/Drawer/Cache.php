<?php

namespace RevealPhp\Graphic\Drawer;

use RevealPhp\Geometry;
use RevealPhp\Graphic;
use RevealPhp\Pattern;

class Cache implements Graphic\Drawer
{
    public function __construct(Graphic\Drawer $drawer)
    {
        $this->drawer = $drawer;
    }

    public function clear(): Graphic\Drawer
    {
        $this->pipeline = [];
        $this->drawer->clear();

        return $this;
    }

    public function drawRectangle(Geometry\Rect $rect, Graphic\Brush $brush): Graphic\Drawer
    {
        $this->addOperation(__FUNCTION__, $rect, $brush);

        return $this;
    }

    public function drawText(Graphic\Text $text): Graphic\Drawer
    {
        $this->addOperation(__FUNCTION__, $text);

        return $this;
    }

    public function drawBitmap(Graphic\Bitmap $bitmap, Geometry\Rect $src, Geometry\Rect $dst): Graphic\Drawer
    {
        $this->addOperation(__FUNCTION__, $bitmap, $src, $dst);

        return $this;
    }

    public function toBitmap(Geometry\Size $size): Graphic\Bitmap
    {
        $this->addOperation(__FUNCTION__, $size);

        $cacheId = Pattern\Identifier::fromIdentifiable(
            self::class,
            ...$this->pipeline
        )->toString();

        return $this->bitmapCache[$cacheId]
            ?? $this->bitmapCache[$cacheId] = $this->callPipeline();
    }

    public function createText(string $text, Graphic\Font $font): Graphic\Text
    {
        return $this->drawer->createText($text, $font);
    }

    public function allMetrics(): iterable
    {
        yield 'BMP CACHE' => count($this->bitmapCache);
        yield from $this->drawer->allMetrics();
    }

    /** @var Graphic\Drawer */
    private $drawer;
    /** @var array<DrawerOperation> */
    private $pipeline = [];
    /** @var array<Graphic\Bitmap> */
    private $bitmapCache = [];

    private function addOperation(string $functionName, Pattern\Identifiable ...$args): void
    {
        /** @var callable $callable */
        $callable = [$this->drawer, $functionName];
        $this->pipeline[] = new DrawerOperation(
            $callable,
            ...$args
        );
    }

    private function callPipeline(): Graphic\Bitmap
    {
        $result = null;
        foreach ($this->pipeline as $operation) {
            $result = $operation();
        }

        return $result;
    }
}

class DrawerOperation implements Pattern\Identifiable
{
    public function __construct(callable $callable, Pattern\Identifiable ...$args)
    {
        $this->callable = $callable;
        $this->args = $args;
    }

    public function identifier(): Pattern\Identifier
    {
        return Pattern\Identifier::fromIdentifiable(
            self::class,
            ...$this->args
        );
    }

    public function __invoke()
    {
        return ($this->callable)(...$this->args);
    }

    private $callable;
    private $args;
}
