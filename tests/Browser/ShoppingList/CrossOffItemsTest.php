<?php

namespace Tests\Browser\ShoppingList;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CrossOffItemsTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testItemCanBeCrossedOffTheListExample()
    {
        $this->browse(function (Browser $browser) {
            $checkbox = "#shopping-item-0 input[type=checkbox]";
            $browser->visit('/items')
                    ->assertNotChecked($checkbox)
                    ->check($checkbox)
                    ->assertChecked($checkbox)
                    ->assertAttribute("#shopping-item-0 div span.name", 'class', 'name line-through');
        });
    }
}
