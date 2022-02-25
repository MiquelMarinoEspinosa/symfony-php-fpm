<?php

declare(strict_types=1);

namespace App\User\Application\Command\CreateUser;

use App\Shared\Domain\Id\IdGenerator;
use App\User\Domain\Entity\User;
use App\User\Domain\Repository\UserRepository;
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
