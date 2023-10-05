<?php

declare(strict_types=1);

namespace App\Tests\Acceptance\User\PhpUnit;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class UserTest extends WebTestCase
{
    public function testCreateUser(): void
    {
        $client = static::createClient();
        $data = [
            'name' => 'phpunit',
            'password' => 'phpunit'
        ];

        $client->request('POST', '/users', [], [], [], json_encode($data));

        $this->assertEquals(
            201,
            $client->getResponse()
                ->getStatusCode()
        );
    }
}
