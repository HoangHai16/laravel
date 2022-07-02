<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => $this->faker->numberBetween(1, 20),
            'brand_id' => $this->faker->numberBetween(1, 20),
            'product_name' => $this->faker->name,
            'product_desc' => $this->faker->text(100),
            'product_content' => $this->faker->text(200),
            'product_price' => $this->faker->randomFloat(null, 10000, 10000000),
            'product_image' => 'product-demo.jpeg',
            'product_status' => $this->faker->numberBetween(0, 1),
            'quantity' => $this->faker->numberBetween(0, 999),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
