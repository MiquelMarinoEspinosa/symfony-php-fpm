<?php

declare(strict_types=1);

namespace App\User\Tests\Unit\Application\Command\CreateUser;

use App\Shared\Domain\Id\Id;
use App\Shared\Domain\Id\IdGenerator;
use App\User\Application\Command\CreateUser\CreateUserCommand;
use App\User\Application\Command\CreateUser\CreateUserHandler;
use App\User\Domain\Entity\User;
use App\User\Domain\Repository\UserRepository;
use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class CreateUserHandlerTest extends TestCase
{
    private UserRepository|MockObject $userRepository;
    private IdGenerator|MockObject $idGenerator;
    private Generator $faker;
    private CreateUserHandler $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepository = $this->createMock(UserRepository::class);
        $this->idGenerator = $this->createMock(IdGenerator::class);
        $this->faker = Factory::create();
        $this->handler = new CreateUserHandler(
            $this->idGenerator,
            $this->userRepository
        );
    }

    public function testShouldThrownAnExceptionWhenUserRepositoryFails(): void
    {
        $this->expectException(\Exception::class);

        $this->idGenerator
            ->expects(self::once())
            ->method('generate')
            ->willReturn(new Id($this->faker->uuid()));

        $this->userRepository
            ->expects(self::once())
            ->method('persist')
            ->willThrowException(new \Exception());

        $command = new CreateUserCommand(
            $this->faker->name(),
            $this->faker->md5()
        );

        $this->handler->__invoke($command);
    }

    public function testShouldCreateTheUser(): void
    {
        $command = new CreateUserCommand(
            $this->faker->name(),
            $this->faker->md5()
        );
        $userId = new Id($this->faker->uuid());
        $this->idGenerator
            ->expects(self::once())
            ->method('generate')
            ->willReturn($userId);

        $user = new User(
            $userId,
            $command->name,
            $command->password
        );
        $this->userRepository
            ->expects(self::once())
            ->method('persist')
            ->with($user);

        $this->handler->__invoke($command);
    }
}
