<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'brand_name' => $this->faker->name,
            'brand_desc' => $this->faker->text(),
            'brand_status' => $this->faker->numberBetween(1, 2),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
