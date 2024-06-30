<?php

declare(strict_types=1);


namespace App\Commands\User;

readonly class UserRegistrationCommand
{
    public function __construct(
        public string $username,
        public string $email,
        public string $password,
    ) {
    }
}
