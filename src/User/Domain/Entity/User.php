<?php

declare(strict_types=1);

namespace App\User\Domain\Entity;

use App\Shared\Domain\Id\Id;

final class User
{
    public function __construct(
        private Id $id,
        private string $name,
        private string $password
    ) {
    }

    public function id(): Id
    {
        return $this->id;
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
