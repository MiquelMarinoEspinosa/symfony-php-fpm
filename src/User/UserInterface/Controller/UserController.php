<?php

declare(strict_types=1);

namespace App\User\UserInterface\Controller;

use App\User\Application\Command\CreateUser\CreateUserCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
        try {
            $body = json_decode($request->getContent(), true);
            $command = new CreateUserCommand(
                $body['name'],
                $body['password']
            );
            $this->bus->dispatch($command);

            return new JsonResponse(null, Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            return new JsonResponse($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
