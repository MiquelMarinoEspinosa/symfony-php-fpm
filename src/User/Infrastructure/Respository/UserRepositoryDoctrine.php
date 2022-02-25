<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Respository;

use App\User\Domain\Entity\User;
use App\User\Domain\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

final class UserRepositoryDoctrine implements UserRepository
{
    private EntityRepository $repository;

    public function __construct(private EntityManagerInterface $entityManager)
    {
        $this->repository = $this->entityManager->getRepository(User::class);
    }

    public function persist(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
