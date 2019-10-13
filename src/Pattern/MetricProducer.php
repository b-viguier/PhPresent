<?php

namespace PhPresent\Pattern;

interface MetricProducer
{
    /**
     * Key is the metric name as string
     * Value is the metric value as string
     */
    public function allMetrics(): iterable;
}
