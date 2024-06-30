<?php

declare(strict_types=1);


namespace App\Repositories\Illuminate;

use App\Commands\User\UserRegistrationCommand;
use App\Models\User;
use App\Queries\User\FindByEmailQuery;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

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

    public function register(UserRegistrationCommand $command): User
    {
        return User::create([
            'username' => $command->username,
            'email' => $command->email,
            'password' => Hash::make($command->password),
        ]);
    }
}
