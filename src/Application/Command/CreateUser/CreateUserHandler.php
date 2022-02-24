<?php

declare(strict_types=1);

namespace App\Application\Command\CreateUser;

use App\Domain\Entity\User;
use App\Shared\Domain\UuidGenerator;
use App\Domain\Repository\UserRepository;

final class CreateUserHandler
{
    public function __construct(
        private UuidGenerator $uuidGenerator,
        private UserRepository $userRepository
    ) {
    }

    public function __invoke(CreateUserCommand $command): void
    {
        $user = new User(
            $this->uuidGenerator->generate(),
            $command->name,
            $command->password
        );

        $this->userRepository->persist($user);
    }
}
