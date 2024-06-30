<?php

declare(strict_types=1);


namespace App\Commands\User;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;

class UserRegistrationHandler
{
    public function __construct(
        private readonly UserRepositoryInterface $repository,
    ) {
    }

    public function handle(UserRegistrationCommand $command): User
    {
        return $this->repository->register($command);
    }
}
