<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\DoctrineTypes;

use App\Shared\Domain\Id\Id;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class IdType extends StringType
{
    public function convertToPHPValue($value, AbstractPlatform $platform): mixed
    {
        return (null !== $value) ? new Id($value) : null;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        return ($value instanceof Id) ? $value->value : null;
    }

    public function getName(): string
    {
        return 'Id';
    }

    protected function getNamespace(): string
    {
        return 'App\Shared\Domain\Id';
    }
}
