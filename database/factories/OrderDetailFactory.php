<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => $this->faker->numberBetween(1, 20),
            'product_id' => $this->faker->numberBetween(1, 20),
            'product_name' => $this->faker->name,
            'product_price' => $this->faker->randomFloat(null, 10000, 100000),
            'product_sales_quantity' => $this->faker->numberBetween(1, 100),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
