<?php

declare(strict_types=1);


namespace App\Queries\User;

readonly class FindByEmailQuery
{
    public function __construct(
        public string $email,
    ) {
    }
}
