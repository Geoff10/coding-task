<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'user_id' => User::factory(),
            'purchased' => false,
        ];
    }

    /**
     * Indicate that the item is purchased.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function purchased()
    {
        return $this->state(function (array $attributes) {
            return [
                'purchased' => true,
            ];
        });
    }
}
