<?php

declare(strict_types=1);

namespace App\User\UserInterface\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\MessageBusInterface;
use App\User\Application\Command\CreateUser\CreateUserCommand;

final class UserController
{
    public function __construct(private MessageBusInterface $bus)
    {
    }

    #[Route('/users', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $body = json_decode($request->getContent(), true);
        $command = new CreateUserCommand(
            $body['name'],
            $body['pass']
        );
        $this->bus->dispatch($command);

        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}
