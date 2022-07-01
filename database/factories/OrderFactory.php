<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'shipping_id' => $this->faker->numberBetween(1, 20),
            'payment_id' => $this->faker->numberBetween(1, 20),
            'customer_id' => $this->faker->numberBetween(1, 20),
            'order_status' => $this->faker->numberBetween(1, 2),
            'order_total' => $this->faker->numberBetween(0, 999),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
