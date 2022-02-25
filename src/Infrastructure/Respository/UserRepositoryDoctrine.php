<?php

namespace App\Infrastructure\Respository;

use App\Domain\Entity\User;
use App\Domain\Repository\UserRepository;
use Doctrine\ORM\EntityRepository;

final class UserRepositroyDoctrine extends EntityRepository implements UserRepository
{
    public function persist(User $user): void
    {
        $this->getEntityManager()->persist($user);
        $this->entityManager()->flush();
    }
}
