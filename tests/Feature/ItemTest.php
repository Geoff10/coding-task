<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ItemTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Check an item can be created
     *
     * @return void
     */
    public function testItemCanBeCreated()
    {
        $user = User::factory()->create();
        $item = 'Spinach';

        $response = $this->post(route('users.items.store', [$user]), [
            'name' => $item,
        ]);

        $response->assertRedirect(route('users.items.index', [$user]));

        $this->assertDatabaseHas('items', [
            'name' => $item
        ]);
    }

    /**
     * Check an item can be marked as purchased
     *
     * @return void
     */
    public function testItemCanBeMarkedAsPurchased()
    {
        $user = User::factory()->create();
        $item = Item::factory()->create();

        $response = $this->put(route('users.items.update', [$user, $item]), [
            'purchased' => true,
        ]);

        $response->assertRedirect(route('users.items.index' [$user]));

        $this->assertDatabaseHas('items', [
            'id' => $item->id,
            'purchased' => true
        ]);
    }

    /**
     * Check an item can be marked as not purchased
     *
     * @return void
     */
    public function testItemCanBeMarkedAsNotPurchased()
    {
        $user = User::factory()->create();
        $item = Item::factory()->purchased()->create();

        $response = $this->put(route('users.items.update', [$user, $item]), [
            'purchased' => false,
        ]);

        $response->assertRedirect(route('users.items.index' [$user]));

        $this->assertDatabaseHas('items', [
            'id' => $item->id,
            'purchased' => false
        ]);
    }

    /**
     * Check an item can be deleted
     *
     * @return void
     */
    public function testItemCanBeDeleted()
    {
        $user = User::factory()->create();
        $item = Item::factory()->create();

        $this->assertDatabaseHas('items', [
            'id' => $item->id,
        ]);

        $response = $this->delete(route('users.items.destroy', [$user, $item]), [
            'purchased' => false,
        ]);

        $response->assertRedirect(route('users.items.index' [$user]));

        $this->assertDatabaseMissing('items', [
            'id' => $item->id,
        ]);
    }
}
