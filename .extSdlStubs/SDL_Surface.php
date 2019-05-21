<?php
/**
 * auto generated file by PHPExtensionStubGenerator
 */
/**
 * auto generated file by PHPExtensionStubGenerator
 */
class SDL_Surface
{

    const SWSURFACE = 0;

    const PREALLOC = 1;

    const RLEACCEL = 2;

    const DONTFREE = 4;

    public $flags = 0;

    public $w = 0;

    public $h = 0;

    public $pitch = 0;

    public $format = null;

    public $clip_rect = null;

    public $pixels = null;

    public function __construct($flags, $width, $height, $depth, $Rmask, $Gmask, $Bmask = null, $Amask = null)
    {
    }

    public function __toString()
    {
    }

    public function Free()
    {
    }

    public function FillRect($rect, $color)
    {
    }

    public function FillRects($rects, $count, $color)
    {
    }

    public function MustLock()
    {
    }

    public function Lock()
    {
    }

    public function Unlock()
    {
    }

    public function Blit(?\SDL_rect $srcrect, \SDL_Surface $dst, ?\SDL_rect &$dstrect = null)
    {
    }

    public function UpperBlit(?\SDL_rect $srcrect, \SDL_Surface $dst, ?\SDL_rect &$dstrect = null)
    {
    }

    public function LowerBlit(\SDL_rect &$srcrect, \SDL_Surface $dst, \SDL_rect &$dstrect)
    {
    }

    public function BlitScaled(?\SDL_rect $srcrect, \SDL_Surface $dst, ?\SDL_rect &$dstrect = null)
    {
    }

    public function UpperBlitScaled(?\SDL_rect $srcrect, \SDL_Surface $dst, ?\SDL_rect &$dstrect = null)
    {
    }

    public function LowerBlitScaled(\SDL_rect &$srcrect, \SDL_Surface $dst, \SDL_rect &$dstrect)
    {
    }

    public function SoftStretch(?\SDL_rect $srcrect, \SDL_Surface $dst, ?\SDL_rect &$dstrect = null)
    {
    }

    public function SaveBMP_RW(\SDL_RWops &$rwops, $freedst = null)
    {
    }

    public function SaveBMP($path)
    {
    }

    public function SetRLE($flag)
    {
    }

    public function SetColorKey($flag, $key = null)
    {
    }

    public function GetColorKey(&$key)
    {
    }

    public function SetColorMod($red, $green, $blue)
    {
    }

    public function GetColorMod(&$red, &$green, &$blue)
    {
    }

    public function SetAlphaMod($alpha)
    {
    }

    public function GetAlphaMod(&$alpha)
    {
    }

    public function SetBlendMode($blendmmode)
    {
    }

    public function GetBlendMode(&$blendmode)
    {
    }

    public function SetClipRect($cliprect)
    {
    }

    public function GetClipRect(&$cliprect)
    {
    }

    public function Convert(\SDL_PixelFormat $format, $flags = null)
    {
    }

    public function ConvertFormat($format, $flags = null)
    {
    }

    public static function LoadRW(\SDL_RWops &$RWops, $freesrc)
    {
    }

    public static function LoadBMP($path)
    {
    }


}
