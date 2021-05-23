<?php

namespace Tests\Browser\ShoppingList;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateItemsTest extends DuskTestCase
{
    /**
     * Check that new items can be added to the list
     *
     * @return void
     */
    public function testNewItemCanBeAddedToList()
    {
        $this->browse(function (Browser $browser) {
            $new_item = 'Spinach';
            $browser->visit('/items')
                ->assertDontSee($new_item)
                ->type('new_item_name', $new_item)
                ->click('#new-item-submit')
                ->assertSee($new_item) // Check the new item is in the list
                ->assertDontSeeIn('#new-item-name', $new_item); // Check form is empty
        });
    }

    public function testDuplicateItemCannotBeAddedToList()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/items');
            $initial_item_count = count($browser->elements('.shopping-item'));
            $first_item = $browser->text('#shopping-item-0 .name');

            $browser->assertSee($first_item)
                ->type('new_item_name', $first_item)
                ->click('#new-item-submit')
                ->assertDontSeeIn('#new-item-name', $first_item); // Check form is empty

            $this->assertCount(
                $initial_item_count,
                $browser->elements('.shopping-item'),
                'There is an unexpected number of items on the page'
            );
        });
    }
}
