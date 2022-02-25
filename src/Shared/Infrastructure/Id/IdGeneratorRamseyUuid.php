<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Id;

use App\Shared\Domain\Id\Id;
use App\Shared\Domain\Id\IdGenerator;
use Ramsey\Uuid\Uuid;

final class IdGeneratorRamseyUuid implements IdGenerator
{
    public function generate(): Id
    {
        return new Id(Uuid::uuid4()->toString());
    }
}
