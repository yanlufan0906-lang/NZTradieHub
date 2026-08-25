<?php

namespace App\Services\Ai;

use App\Contracts\DescriptionImprover;
use App\Exceptions\DescriptionImprovementException;

class UnavailableDescriptionImprover implements DescriptionImprover
{
    public function __construct(private readonly string $provider) {}

    public function improve(string $description): string
    {
        throw new DescriptionImprovementException(
            "The configured AI description provider [{$this->provider}] is not supported.",
        );
    }
}
