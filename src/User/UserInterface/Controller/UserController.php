<?php

namespace App\User\UserInterface\Controller;

use App\User\Application\Command\CreateUser\CreateUserCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

final class UserController
{
    public function __construct(private MessageBusInterface $bus)
    {
    }

    #[Route('/users', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $command = new CreateUserCommand(
            'miquel',
            'pass'
        );
        $this->bus->dispatch($command);

        return new JsonResponse(['response' => 'ok']);
    }
}
