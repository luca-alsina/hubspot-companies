<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrowserSessionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_other_browser_sessions_can_be_logged_out(): void
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->delete(route('other-browser-sessions.destroy'), [
            'password' => 'test',
        ]);

        $response->assertSessionHasNoErrors();
    }
}
