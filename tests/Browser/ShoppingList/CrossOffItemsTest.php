<?php

namespace Tests\Browser\ShoppingList;

use App\Models\Item;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CrossOffItemsTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testItemCanBeCrossedOffTheListExample()
    {
        Item::factory()->count(2)->create();

        $this->browse(function (Browser $browser) {
            $checkbox = "#shopping-item-1 input[type=checkbox]";
            $browser->visit('/items')
                    ->assertNotChecked($checkbox)
                    ->check($checkbox)
                    ->pause(500)
                    ->assertChecked($checkbox)
                    ->assertAttribute("#shopping-item-1 div span.name", 'class', 'name line-through')
                    ->refresh()
                    ->assertChecked($checkbox, 'Crossing items off of the list is not persisting across page reloads');
        });
    }
}
