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

        $this->browse(function (Browser $browser) {
            $user = User::factory()->create();
            $items = Item::factory()->count(2)->for($user)->create();

            $browser->loginAs($user);
            $browser->visitRoute('users.items.index', [$user]);

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

        $this->browse(function (Browser $browser) {
            $user = User::factory()->create();
            $user_items = Item::factory()->count(2)->for($user)->create();
            $other_items = Item::factory()->count(2)->create();

            $browser->loginAs($user);
            $browser->visitRoute('users.items.index', [$user]);

            foreach ($user_items as $item) {
                $browser->assertSee($item->name);
            }

            foreach ($other_items as $item) {
                $browser->assertDontSee($item->name);
            }
        });
    }
}
