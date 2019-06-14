<?php

namespace RevealPhp\Graphic;

use RevealPhp\Pattern;

class ImageFile
{
    use Pattern\PrivateConstructor;

    public static function fromPath(string $path): self
    {
        if (!file_exists($path) || !is_readable($path)) {
            throw new \InvalidArgumentException("File [$path] is not accessible");
        }

        $imageFile = new self();
        $imageFile->path = $path;

        return $imageFile;
    }

    public function path(): string
    {
        return $this->path;
    }

    /** @var string */
    private $path = '';
}
