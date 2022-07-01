<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Category_name' => $this->faker->name,
            'Category_desc' => $this->faker->text(),
            'Category_status' => $this->faker->numberBetween(1, 2),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
