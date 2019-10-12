<?php

namespace RevealPhp\Graphic;

interface BitmapSequenceLoader
{
    public function fromFile(string $filePath): BitmapSequence;
}
