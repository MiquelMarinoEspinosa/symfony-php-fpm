<?php

namespace App\Domain\Repository;

use App\Domain\Entity\User;

interface UserRepository 
{
  public function persist(User $user);
}