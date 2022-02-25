<?php

declare(strict_types=1);

namespace App\User\Application\Command\CreateUser;

final class CreateUserCommand
{
    public function __construct(
        public readonly string $name,
        public readonly string $password
    ) {
    }
}
