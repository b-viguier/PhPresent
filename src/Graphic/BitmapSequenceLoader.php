<?php

namespace PhPresent\Graphic;

interface BitmapSequenceLoader
{
    public function fromFile(string $filePath): BitmapSequence;
}
