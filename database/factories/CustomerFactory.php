<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_name' => $this->faker->name,
            'customer_email' => $this->faker->email(),
            'customer_password' => $this->faker->password(),
            'customer_phone' => $this->faker->phoneNumber(),
            'customer_address' => $this->faker->name,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
