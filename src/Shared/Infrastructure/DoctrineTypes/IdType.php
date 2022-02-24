<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\DoctrineTypes;

use App\Shared\Domain\Id;
use Doctrine\DBAL\Types\StringType;
use Doctrine\DBAL\Platforms\AbstractPlatform;

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
        return 'App\Shared\Domain';
    }
}
