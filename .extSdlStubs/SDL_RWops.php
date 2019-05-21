<?php
/**
 * auto generated file by PHPExtensionStubGenerator
 */
/**
 * auto generated file by PHPExtensionStubGenerator
 */
class SDL_RWops
{

    const UNKNOWN = 0;

    const WINFILE = 1;

    const STDFILE = 2;

    const JNIFILE = 3;

    const MEMORY = 4;

    const MEMORY_RO = 5;

    public $type = 0;

    public function __construct()
    {
    }

    public function __toString()
    {
    }

    public function Free()
    {
    }

    public function Size()
    {
    }

    public function Seek($offset, $whence)
    {
    }

    public function Tell()
    {
    }

    public function Read(&$buffer, $size, $number = null)
    {
    }

    public function Write($buffer, $size = null, $number = null)
    {
    }

    public function Close()
    {
    }

    public function ReadU8()
    {
    }

    public function ReadLE16()
    {
    }

    public function ReadBE16()
    {
    }

    public function ReadLE32()
    {
    }

    public function ReadBE32()
    {
    }

    public function ReadLE64()
    {
    }

    public function ReadBE64()
    {
    }

    public function WriteU8($value)
    {
    }

    public function WriteLE16($value)
    {
    }

    public function WriteBE16($value)
    {
    }

    public function WriteLE32($value)
    {
    }

    public function WriteBE32($value)
    {
    }

    public function WriteLE64($value)
    {
    }

    public function WriteBE64($value)
    {
    }

    public static function FromFile($path, $mode)
    {
    }

    public static function FromFP($fp, $autoclose = null)
    {
    }

    public static function FromMem(&$buf, $size)
    {
    }

    public static function FromConstMem($buf, $size = null)
    {
    }


}
