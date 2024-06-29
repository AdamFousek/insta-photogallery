<?php

namespace Tests\Feature\Queries;

use App\Queries\User\FindByEmailHandler;
use App\Queries\User\FindByEmailQuery;
use App\Queries\User\FindByUsernameHandler;
use App\Queries\User\FindByUsernameQuery;
use Tests\TestCase;
use Tests\Traits\CreateUserTrait;

class UserFindByUsernameTest extends TestCase
{
    use CreateUserTrait;

    public function test_find_by_username(): void
    {
        $user = $this->createUser();
        $username = $user->username;
        /** @var FindByUsernameHandler $findByUsername */
        $findByUsername = $this->app->make(FindByUsernameHandler::class);
        $findUser = $findByUsername->handle(new FindByUsernameQuery($username));

        $this->assertNotNull($findUser);
        $this->assertSame($user->id, $findUser->id);
    }

    public function test_find_by_email_null(): void
    {
        /** @var FindByUsernameHandler $findByUsername */
        $findByUsername = $this->app->make(FindByUsernameHandler::class);
        $findUser = $findByUsername->handle(new FindByUsernameQuery('super_random_username'));
        $this->assertNull($findUser);
    }
}
