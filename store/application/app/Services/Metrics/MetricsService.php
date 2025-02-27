<?php

namespace app\Services\Metrics;

use OpenTelemetry\SDK\Common\Attribute\Attributes;

class MetricsService
{
    private MetricsRegistry $registry;

    public function __construct(MetricsRegistry $registry)
    {
        $this->registry = $registry;
    }

    public function incrementCounter(string $counterName, int $amount = 1, array $attributes = []): void
    {
        $this->registry->getCounter($counterName)?->add($amount, Attributes::create($attributes));
    }

    public function recordHistogram(string $histogramName, float $value, array $attributes = []): void
    {
        $this->registry->getHistogram($histogramName)?->record($value, Attributes::create($attributes));
    }
}
