<?php

namespace Tests\Feature\Validation;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\CreateUserTrait;

class ValidateUsernameTest extends TestCase
{
    use RefreshDatabase;
    use CreateUserTrait;

    /**
     * A basic feature test example.
     */
    public function test_validate_username(): void
    {
        $randomUsername = fake()->firstName . fake()->lastName;
        $response = $this->post(route('validate.username'), [
            'username' => $randomUsername,
        ]);

        $response->assertJsonStructure([
            'message',
            'error'
        ]);
        $response->assertStatus(200);
    }

    public function test_validate_existing_username(): void
    {
        $user = $this->createUser();
        $username = $user->username;
        $response = $this->post(route('validate.username'), [
            'username' => $username,
        ]);

        $response->assertJsonStructure([
            'message',
            'error'
        ]);
        $response->assertStatus(400);
    }

    /**
     * Invalid for min:4
     * @return void
     */
    public function test_validate_invalid_min_length_username(): void
    {
        $username = 'low';
        $response = $this->post(route('validate.username'), [
            'username' => $username,
        ]);

        $response->assertJsonStructure([
            'message',
            'error'
        ]);
        $response->assertStatus(400);
    }

    /**
     * Invalid for aplha_num
     * @return void
     */
    public function test_validate_invalid_alpha_num_username(): void
    {
        $username = 'wrong name with space';
        $response = $this->post(route('validate.username'), [
            'username' => $username,
        ]);

        $response->assertJsonStructure([
            'message',
            'error'
        ]);
        $response->assertStatus(400);
    }
}
