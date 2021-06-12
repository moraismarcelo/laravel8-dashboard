<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'detail' => $this->faker->paragraph(10),
            'price' => $this->faker->numberBetween(1,1000000),
            'active' => $this->faker->numberBetween(0,1),
            'discount' => $this->faker->numberBetween(0,100),
        ];
    }
}
