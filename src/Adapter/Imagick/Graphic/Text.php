<?php

namespace PhPresent\Adapter\Imagick\Graphic;

use PhPresent\Geometry;
use PhPresent\Graphic;

class Text extends Graphic\Text
{
    public function __construct(string $text, Graphic\Font $font, array $metrics)
    {
        // Assuming topLeft is on (0,0), where should text be traced?
        switch ($font->alignment()) {
            case Graphic\Font::ALIGN_LEFT:
                $textPosition = Geometry\Point::fromCoordinates(
                    0,
                    $metrics['ascender']
                );
                break;
            case Graphic\Font::ALIGN_CENTER:
                $textPosition = Geometry\Point::fromCoordinates(
                    $metrics['textWidth'] / 2,
                    $metrics['ascender']
                );
                break;
            case Graphic\Font::ALIGN_RIGHT:
                $textPosition = Geometry\Point::fromCoordinates(
                    $metrics['textWidth'],
                    $metrics['ascender']
                );
                break;
            default:
                $textPosition = Geometry\Point::origin();
        }

        parent::__construct(
            $text,
            $font,
            Geometry\Rect::fromSize(
                Geometry\Size::fromDimensions($metrics['textWidth'], $metrics['textHeight'])
            ),
            $textPosition
        );
    }
}
