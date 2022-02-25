<?php

declare(strict_types=1);

namespace App\Shared\Domain\Id;

interface IdGenerator
{
    public function generate(): Id;
}
