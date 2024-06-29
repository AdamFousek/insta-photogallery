<?php

namespace Tests\Feature\Validation;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\CreateUserTrait;

class ValidateEmailTest extends TestCase
{
    use RefreshDatabase;
    use CreateUserTrait;

    /**
     * A basic feature test example.
     */
    public function test_validate_email(): void
    {
        $randomEmail = fake()->email();
        $response = $this->post(route('validate.email'), [
            'email' => $randomEmail,
        ]);

        $response->assertJsonStructure([
            'message',
            'error'
        ]);
        $response->assertStatus(200);
    }

    public function test_validate_existing_email(): void
    {
        $user = $this->createUser();
        $email = $user->email;

        $response = $this->post(route('validate.email'), [
            'email' => $email,
        ]);

        $response->assertJsonStructure([
            'message',
            'error'
        ]);
        $response->assertStatus(400);
    }

    public function test_validate_unvalid_email(): void
    {
        $email = 'wrong.email';
        $response = $this->post(route('validate.email'), [
            'email' => $email,
        ]);

        $response->assertJsonStructure([
            'message',
            'error'
        ]);
        $response->assertStatus(400);
    }
}
