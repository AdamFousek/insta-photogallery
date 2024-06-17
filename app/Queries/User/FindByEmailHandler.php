<?php

declare(strict_types=1);


namespace App\Queries\User;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;

class FindByEmailHandler
{
    public function __construct(
        private readonly UserRepositoryInterface $repository,
    ) {
    }

    public function handle(FindByEmailQuery $query): ?User
    {
        return $this->repository->getByEmail($query);
    }
}
