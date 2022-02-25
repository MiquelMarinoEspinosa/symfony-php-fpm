<?php

declare(strict_types=1);

namespace App\Shared\Domain\Id;

class Id
{
    public function __construct(
        public readonly string $value
    ) {
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
