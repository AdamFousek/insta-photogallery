<?php

declare(strict_types=1);


namespace App\Repositories\Illuminate;

use App\Models\User;
use App\Queries\User\FindByEmailQuery;
use App\Repositories\UserRepositoryInterface;

class IlluminateUserRepository implements UserRepositoryInterface
{

    public function byUsername(string $username): ?User
    {
        return User::where('username', $username)->first();
    }

    public function getByEmail(FindByEmailQuery $query): ?User
    {
        return User::where('email', $query->email)->first();
    }
}
