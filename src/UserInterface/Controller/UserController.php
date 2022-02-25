<?php

namespace App\UserInterface\Controller;

use App\Application\Command\CreateUser\CreateUserCommand;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\MessageBusInterface;

final class UserController
{
    public function __construct(private MessageBusInterface $bus)
    {
    }

    #[Route("/users", methods: ["POST"])]
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
