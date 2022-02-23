<?php

namespace App\Application\Command\CreateUser;

use App\Domain\Repository\UserRepository;

final class CreateUserHandler
{
  public function __construct(
    private UserRepository $userRepository
  )
  {

  }
  
  public function __invoke(CreateUserCommand $command): void
  {
        
  }
}
