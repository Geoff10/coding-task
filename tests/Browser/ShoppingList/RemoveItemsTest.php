<?php

namespace Tests\Browser\ShoppingList;

use App\Models\Item;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RemoveItemsTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Check that an item can be removed from the list.
     *
     * @return void
     */
    public function testItemCanBeRemoved()
    {
        Item::factory()->count(2)->create();

        $this->browse(function (Browser $browser) {
            $browser->visit('/items');
            $initial_item_count = count($browser->elements('.shopping-item'));
            $first_item = $browser->text('#shopping-item-1 .name');

            $browser->assertSee($first_item)
                    ->click('#shopping-item-1 .delete-btn')
                    ->assertDontSee($first_item);

            $this->assertCount(
                $initial_item_count - 1,
                $browser->elements('.shopping-item'),
                'There is an unexpected number of items on the page. An item may not have been deleted.'
            );

            $browser->refresh();

            $this->assertCount(
                $initial_item_count - 1,
                $browser->elements('.shopping-item'),
                'Item deletion is not persisting across page reloads.'
            );
        });
    }
}
