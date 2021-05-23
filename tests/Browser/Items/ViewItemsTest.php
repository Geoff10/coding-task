<?php

namespace Tests\Browser\ShoppingList;

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
        $this->browse(function (Browser $browser) {
            $browser->visit('/items')
                    ->assertSee('Tofu')
                    ->assertSee('Courgette');
        });
    }
}
