<?php

namespace Tests\Feature;

use App\Models\Item;
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
        $item = 'Spinach';

        $response = $this->post('/items', [
            'name' => $item,
        ]);

        $response->assertRedirect('/items');

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
        $item = Item::factory()->make();

        $response = $this->put("/items/{$item->id}", [
            'purchased' => true,
        ]);

        $response->assertRedirect('/items');

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
        $item = Item::factory()->purchased()->make();

        $response = $this->put("/items/{$item->id}", [
            'purchased' => false,
        ]);

        $response->assertRedirect('/items');

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
        $item = Item::factory()->make();

        $this->assertDatabaseHas('items', [
            'id' => $item->id,
        ]);

        $response = $this->delete("/items/{$item->id}", [
            'purchased' => false,
        ]);

        $response->assertRedirect('/items');

        $this->assertDatabaseMissing('items', [
            'id' => $item->id,
        ]);
    }
}
