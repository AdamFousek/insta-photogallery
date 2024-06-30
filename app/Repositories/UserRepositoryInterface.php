<?php

declare(strict_types=1);


namespace App\Repositories;

use App\Commands\User\UserRegistrationCommand;
use App\Models\User;
use App\Queries\User\FindByEmailQuery;

interface UserRepositoryInterface
{
    public function byUsername(string $username): ?User;

    public function getByEmail(FindByEmailQuery $query): ?User;

    public function register(UserRegistrationCommand $command): User;
}
