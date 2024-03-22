<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_register_with_valid_information()
    {
        $response = $this->post('/register', [
            'name' => 'New User',
            'email' => 'newuser@example.com',
            'password' => 'validPassword123',
            'password_confirmation' => 'validPassword123',
        ]);

        $response->assertRedirect('/dashboard'); // or wherever a new user should be redirected to
        $this->assertDatabaseHas('users', [
            'email' => 'newuser@example.com',
        ]);
    }

    /** @test */
    public function a_user_cannot_register_with_invalid_information()
    {
        $response = $this->post('/register', [
            'name' => '',
            'email' => 'not-an-email',
            'password' => 'short',
            'password_confirmation' => 'short',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }

    /** @test */
    public function a_user_cannot_register_with_a_password_not_matching_confirmation()
    {
        $response = $this->post('/register', [
            'name' => 'New User',
            'email' => 'newuser@example.com',
            'password' => 'validPassword123',
            'password_confirmation' => 'mismatchingPassword',
        ]);

        $response->assertSessionHasErrors(['password']);
    }
    
}
