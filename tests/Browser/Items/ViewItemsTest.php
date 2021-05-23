<?php

namespace Tests\Browser\ShoppingList;

use App\Models\Item;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ViewItemsTest extends DuskTestCase
{
    /**
     * Check that the shopping list items can be viewed.
     *
     * @return void
     */
    public function testItemListCanBeViewed()
    {
        $items = Item::factory()->create(2)->make();

        $this->browse(function (Browser $browser) use ($items) {
            $browser->visit('/items');

            foreach ($items as $item) {
                $browser->assertSee($item->name);
            }
        });
    }
}
