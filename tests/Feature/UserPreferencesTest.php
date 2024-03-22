<?php

// tests/Feature/UserPreferencesTest.php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserPreferencesTest extends TestCase
{
    use RefreshDatabase;

    public function test_preferences_form_is_accessible_to_authenticated_users()
    {
        // Create a user
        $user = User::factory()->create();

        // Act as the created user
        $response = $this->actingAs($user)->get('/profile/preferences');

        // Assert the response status is 200 (OK)
        $response->assertStatus(200);
    }
}

