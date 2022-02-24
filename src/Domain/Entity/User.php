<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Shared\Domain\Uuid;

final class User
{
    public function __construct(
        private Uuid $id,
        private string $name,
        private string $password
    ) {
    }

    public function id(): string
    {
        return $this->id->value;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function password(): string
    {
        return $this->password;
    }
}
