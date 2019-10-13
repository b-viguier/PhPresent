<?php

namespace PhPresent\Adapter\SDL\Render\PostRenderer;

use PhPresent\Adapter\SDL\Render\DbgTextRenderer;
use PhPresent\Adapter\SDL\Render\PostRenderer;
use PhPresent\Geometry;
use PhPresent\Pattern;
use PhPresent\Presentation;

class Statistics implements PostRenderer
{
    public function __construct(DbgTextRenderer $textRenderer, Pattern\MetricProducer ...$metricProducers)
    {
        $this->textRenderer = $textRenderer;
        $this->lastTimestamp = microtime(true);
        $this->metricProducers = $metricProducers;
    }

    public function render($sdlRenderer, Presentation\Screen $screen): void
    {
        $size = (int) ($screen->safeArea()->size()->height() / 30);

        // FPS
        $currentTimestamp = microtime(true);
        $fps = (int) (1 / ($currentTimestamp - $this->lastTimestamp));
        $this->lastTimestamp = $currentTimestamp;

        // Memory
        $mem = (int) (memory_get_usage() / 1000); /* for Kb */

        $this->textRenderer->render(
            $sdlRenderer,
            "FPS:$fps\nMEM:$mem KB",
            $screen->fullArea()->topLeft(),
            $size
        );

        // Others
        $lineOffset = 1 * $size;
        foreach ($this->metricProducers as $metricProducer) {
            foreach ($metricProducer->allMetrics() as $name => $value) {
                $this->textRenderer->render(
                    $sdlRenderer,
                    "$name:$value",
                    $screen->fullArea()->topLeft()->movedBy(
                        Geometry\Vector::fromCoordinates(0, $lineOffset += $size)
                    ),
                    $size
                );
            }
        }
    }

    /** @var DbgTextRenderer */
    private $textRenderer;

    /** @var float */
    private $lastTimestamp;

    /** @var array<Pattern\MetricProducer> */
    private $metricProducers = [];
}
