<?php

declare(strict_types=1);


namespace App\Queries\User;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;

readonly class FindByUsernameHandler
{
    public function __construct(
        private UserRepositoryInterface $repository,
    ) {
    }

    public function handle(FindByUsernameQuery $query): ?User
    {
        return $this->repository->byUsername($query->username);
    }
}
