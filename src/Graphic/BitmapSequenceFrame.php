<?php

namespace RevealPhp\Graphic;

use RevealPhp\Pattern;

class BitmapSequenceFrame implements Pattern\Identifiable
{
    public function __construct(string $content, int $durationMs)
    {
        $this->content = $content;
        $this->duration = $durationMs;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function duration(): int
    {
        return $this->duration;
    }

    public function identifier(): Pattern\Identifier
    {
        return Pattern\Identifier::fromString(
            self::class,
            $this->content,
            $this->duration
        );
    }

    /** @var string */
    private $content = '';
    /** @var int */
    private $duration = 0;
}
