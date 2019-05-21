<?php
/**
 * auto generated file by PHPExtensionStubGenerator
 */
/**
 * auto generated file by PHPExtensionStubGenerator
 */
class SDL_MessageBoxData
{

    const ERROR = 16;

    const WARNING = 32;

    const INFORMATION = 64;

    public $flags = 0;

    public $title = null;

    public $message = null;

    public $window = false;

    public $numbuttons = 0;

    public $buttons = null;

    public $colors = null;

    public function __construct($flags, $title, $message, array $buttons = null, array $colors = null, \SDL_Window $parentwindow = null)
    {
    }

    public function __toString()
    {
    }

    public function Show(&$buttonid)
    {
    }


}
