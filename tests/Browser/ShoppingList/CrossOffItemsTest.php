<?php

namespace Tests\Browser\ShoppingList;

use App\Models\Item;
use App\Models\User;
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

        $this->browse(function (Browser $browser) {
            $user = User::factory()->create();
            Item::factory()->count(2)->for($user)->create();

            $checkbox = "#shopping-item-1 input[type=checkbox]";
            $browser->loginAs($user);
            $browser->visitRoute('users.items.index', [$user])
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
