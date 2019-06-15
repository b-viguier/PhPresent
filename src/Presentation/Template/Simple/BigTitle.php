<?php

namespace RevealPhp\Presentation\Template\Simple;

use RevealPhp\Graphic;
use RevealPhp\Presentation;

class BigTitle implements Presentation\Slide
{
    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function render(Graphic\Drawer $drawer, Graphic\Theme $theme): string
    {
        $area = $drawer->getArea();

        return $drawer->text(
            $this->title,
            $area->center(),
            $theme->font()
                ->withAlignment(Graphic\Font::ALIGN_CENTER)
                ->withSize($area->size()->height() / 6),
            $theme->brush()
        )->getBmpData();
    }

    /** @var string */
    private $title = '';
}
