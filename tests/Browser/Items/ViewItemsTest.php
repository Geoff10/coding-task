<?php

namespace Tests\Browser\ShoppingList;

use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ViewItemsTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Check that the shopping list items can be viewed.
     *
     * @return void
     */
    public function testItemListCanBeViewed()
    {
        $items = Item::factory()->count(2)->create();

        $this->browse(function (Browser $browser) use ($items) {
            $browser->visit('/items');

            foreach ($items as $item) {
                $browser->assertSee($item->name);
            }
        });
    }

    /**
     * Check that only a user's items are visible.
     *
     * @return void
     */
    public function testOnlyUsersItemListCanBeViewed()
    {
        $user = User::factory()->create();
        $user_items = Item::factory()->count(2)->for($user)->create();
        $other_items = Item::factory()->count(2)->create();

        $this->browse(function (Browser $browser) use ($user_items, $other_items) {
            $browser->visit('/items');

            foreach ($user_items as $item) {
                $browser->assertSee($item->name);
            }

            foreach ($other_items as $item) {
                $browser->assertDontSee($item->name);
            }
        });
    }
}
