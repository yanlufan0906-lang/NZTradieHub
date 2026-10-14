<?php

namespace App\Contracts;

interface DescriptionImprover
{
    public function improve(string $description): string;
}
