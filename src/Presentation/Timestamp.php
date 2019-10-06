<?php

namespace RevealPhp\Presentation;

use RevealPhp\Pattern;

class Timestamp
{
    use Pattern\PrivateConstructor;

    public static function origin(float $unixTimestamp): self
    {
        $timestamp = new self();
        $timestamp->absolute = 0;
        $timestamp->relative = 0;
        $timestamp->origin = $unixTimestamp;

        return $timestamp;
    }

    public function nextFrame(float $unixTimestamp): self
    {
        $absolute = intval(($unixTimestamp - $this->origin) * 1000);

        $timestamp = new self();
        $timestamp->relative = $this->relative + ($absolute - $this->absolute);
        $timestamp->absolute = $absolute;
        $timestamp->origin = $this->origin;

        return $timestamp;
    }

    public function nextSlide(float $unixTimestamp): self
    {
        $timestamp = $this->nextFrame($unixTimestamp);
        $timestamp->relative = 0;

        return $timestamp;
    }

    /**
     * @return int number of milliseconds from last slide
     */
    public function slideRelative(): int
    {
        return $this->relative;
    }

    /**
     * @return int numer of milliseconds from the beginning of the presentation
     */
    public function absolute(): int
    {
        return $this->absolute;
    }

    /** @var int */
    private $absolute;
    /** @var int */
    private $relative;
    /** @var float */
    private $origin;
}
