<?php

namespace Tests\Feature\Queries;

use App\Queries\User\FindByEmailHandler;
use App\Queries\User\FindByEmailQuery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\CreateUserTrait;

class UserFindByEmailTest extends TestCase
{
    use CreateUserTrait;

    /**
     * A basic feature test example.
     */
    public function test_find_by_email(): void
    {
        $user = $this->createUser();
        $email = $user->email;
        /** @var FindByEmailHandler $findByEmailHandler */
        $findByEmailHandler = $this->app->make(FindByEmailHandler::class);
        $findUser = $findByEmailHandler->handle(new FindByEmailQuery($email));

        $this->assertNotNull($findUser);
        $this->assertSame($user->id, $findUser->id);
    }

    public function test_find_by_email_null(): void
    {
        /** @var FindByEmailHandler $findByEmailHandler */
        $findByEmailHandler = $this->app->make(FindByEmailHandler::class);
        $findUser = $findByEmailHandler->handle(new FindByEmailQuery('random@email.wyz'));
        $this->assertNull($findUser);
    }
}
