<?php

declare(strict_types=1);

namespace App\Tests\Acceptance\User;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;

/**
 * This context class contains the definitions of the steps used by the demo
 * feature file. Learn how to get started with Behat and BDD on Behat's website.
 *
 * @see http://behat.org/en/latest/quick_start.html
 */
final class UserContext implements Context
{
    private array $credentials;
    private string|bool $response;
    private string $error;
    private int $httpCode;

    /**
     * @Given the user credentials
     */
    public function userCredentials(TableNode $table): void
    {
        $this->credentials = $table->getColumnsHash()[0];
    }

    /**
     * @When make the create user request
     */
    public function makeCreateUser(): void
    {
        $ch = curl_init();
        $data = [
            'name' => $this->credentials['name'],
            'password' => $this->credentials['password'],
        ];
        curl_setopt($ch, CURLOPT_URL, 'http://app.nginx/users');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            json_encode($data)
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        $this->response = curl_exec($ch);
        $this->error = curl_error($ch);
        $this->httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    }

    /**
     * @Then the user should be created
     */
    public function theUserHasBeenCreated(): void
    {
        if (false === $this->response || $this->httpCode !== 201) {
            $message = $this->error ?: $this->response;
            throw new \RuntimeException($message);
        }
    }
}
