<?php

namespace Tests\Browser\ShoppingList;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RemoveItemsTest extends DuskTestCase
{
    /**
     * Check that an item can be removed from the list.
     *
     * @return void
     */
    public function testItemCanBeRemoved()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/items');
            $initial_item_count = count($browser->elements('.shopping-item'));
            $first_item = $browser->text('#shopping-item-0 .name');

            $browser->assertSee($first_item)
                    ->click('#shopping-item-0 .delete-btn')
                    ->assertDontSee($first_item);

            $this->assertCount(
                $initial_item_count - 1,
                $browser->elements('.shopping-item'),
                'There is an unexpected number of items on the page. An item may not have been deleted.'
            );
        });
    }
}
