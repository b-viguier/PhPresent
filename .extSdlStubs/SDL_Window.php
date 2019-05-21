<?php
/**
 * auto generated file by PHPExtensionStubGenerator
 */
/**
 * auto generated file by PHPExtensionStubGenerator
 */
class SDL_Window
{

    const FULLSCREEN = 1;

    const OPENGL = 2;

    const SHOWN = 4;

    const HIDDEN = 8;

    const BORDERLESS = 16;

    const RESIZABLE = 32;

    const MINIMIZED = 64;

    const MAXIMIZED = 128;

    const INPUT_GRABBED = 256;

    const INPUT_FOCUS = 512;

    const MOUSE_FOCUS = 1024;

    const FULLSCREEN_DESKTOP = 4097;

    const FOREIGN = 2048;

    const ALLOW_HIGHDPI = 8192;

    const POS_UNDEFINED_MASK = 536805376;

    const POS_UNDEFINED = 536805376;

    const POS_CENTERED_MASK = 805240832;

    const POS_CENTERED = 805240832;

    public $id = 0;

    public $flags = 0;

    public $x = 0;

    public $y = 0;

    public $w = 0;

    public $h = 0;

    public $title = null;

    public function __construct($title, $x, $y, $w, $h, $flags)
    {
    }

    public function __toString()
    {
    }

    public function UpdateSurface()
    {
    }

    public function Destroy()
    {
    }

    public function GetTitle()
    {
    }

    public function SetTitle($title)
    {
    }

    public function GetDisplayIndex()
    {
    }

    public function Show()
    {
    }

    public function Hide()
    {
    }

    public function Raise()
    {
    }

    public function Maximize()
    {
    }

    public function Minimize()
    {
    }

    public function Restore()
    {
    }

    public function GetSurface()
    {
    }

    public function SetDisplayMode(\SDL_DisplayMode $displaymode)
    {
    }

    public function GetDisplayMode(&$displaymode)
    {
    }

    public function GetPixelFormat()
    {
    }

    public function GetID()
    {
    }

    public function GetFlags()
    {
    }

    public function SetIcon(\SDL_Surface $icon)
    {
    }

    public function SetPosition($x, $y)
    {
    }

    public function GetPosition(&$x = null, &$y = null)
    {
    }

    public function SetSize($w, $h)
    {
    }

    public function GetSize(&$w = null, &$h = null)
    {
    }

    public function SetMinimumSize($x, $y)
    {
    }

    public function GetMinimumSize(&$x = null, &$y = null)
    {
    }

    public function SetMaximumSize($x, $y)
    {
    }

    public function GetMaximumSize(&$x = null, &$y = null)
    {
    }

    public function SetBordered($bordered)
    {
    }

    public function SetFullscreen($flags)
    {
    }

    public function UpdateSurfaceRects(array $rects, $numrect = null)
    {
    }

    public function SetGrab($grabbed)
    {
    }

    public function GetGrab()
    {
    }

    public function SetBrightness($brightness)
    {
    }

    public function GetBrightness()
    {
    }

    public function GetGammaRamp(&$red, &$green, &$blue)
    {
    }

    public function GL_CreateContext()
    {
    }

    public function GL_MakeCurrent(\SDL_GLContext $GLcontext)
    {
    }

    public function GL_GetDrawableSize(&$x = null, &$y = null)
    {
    }

    public function GL_Swap()
    {
    }

    public function WarpMouse($x, $y)
    {
    }

    public function IsShaped()
    {
    }

    public function SetShape(\SDL_Surface $surface, \SDL_WindowShapeMode $mode)
    {
    }

    public function GetShapedMode(&$shaped_mode)
    {
    }

    public static function GL_GetCurrent()
    {
    }

    public static function GetMouseFocus()
    {
    }


}
