<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ItemAccessTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Check a list cannot be access when a user is not logged in.
     *
     * @return void
     */
    public function testCannotAccessListWhenNotLoggedIn()
    {
        $user = User::factory()->create();
        $response = $this->get(route('users.items.index', [$user]));

        $response->assertStatus(403);
    }

    /**
     * Check a list can be accessed by it's user.
     *
     * @return void
     */
    public function testCanAccessListWhenLoggedIn()
    {
        $user = User::factory()->create();

        Auth::login($user);
        $response = $this->get(route('users.items.index', [$user]));

        $response->assertStatus(200);
    }

    /**
     * Check a list cannot be accessed by another user.
     *
     * @return void
     */
    public function testCannotAccessAnotherListWhenLoggedIn()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        Auth::login($user1);
        $response = $this->get(route('users.items.index', [$user2]));

        $response->assertStatus(403);
    }
}
