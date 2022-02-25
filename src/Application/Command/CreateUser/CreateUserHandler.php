<?php

declare(strict_types=1);

namespace App\Application\Command\CreateUser;

use App\Domain\Entity\User;
use App\Shared\Domain\IdGenerator;
use App\Domain\Repository\UserRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class CreateUserHandler
{
    public function __construct(
        private IdGenerator $idGenerator,
        private UserRepository $userRepository
    ) {
    }

    public function __invoke(CreateUserCommand $command): void
    {
        $user = new User(
            $this->idGenerator->generate(),
            $command->name,
            $command->password
        );

        $this->userRepository->persist($user);
    }
}
