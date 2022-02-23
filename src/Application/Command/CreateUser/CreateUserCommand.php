<?php

namespace App\Application\Command\CreateUser;

final class CreateUserCommand
{
    public function __construct(
      public readonly string $id,
      public readonly string $name,
      public readonly string $password
   ) {
    }
}
