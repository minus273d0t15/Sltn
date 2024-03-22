<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserPreference;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsFeedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_view_news_feed_based_on_preferences()
    {
        // Create a user
        $user = User::factory()->create();

        // Simulate user preference
        $preferences = UserPreference::create([
            'user_id' => $user->id,
            'categories' => json_encode(['technology', 'business']), // Sample categories
        ]);

        // Acting as the user, visit the dashboard
        $response = $this->actingAs($user)->get('/dashboard');

        // Check that the correct view is returned
        $response->assertStatus(200);
        $response->assertViewIs('dashboard');

        // Optionally, check that the view has certain data
        $response->assertViewHas('newsItems', function ($viewNewsItems) use ($preferences) {
            return in_array('technology', array_keys($viewNewsItems)) && in_array('business', array_keys($viewNewsItems));
        });
    }

}
