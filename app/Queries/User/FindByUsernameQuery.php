<?php

declare(strict_types=1);


namespace App\Queries\User;

readonly class FindByUsernameQuery
{
    public function __construct(
        public string $username,
    ) {
    }
}
