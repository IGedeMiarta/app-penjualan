<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create();

        $name = $faker->words;
        $nameString = implode(' ', $name);
        return [
            'product_name'  => $nameString,
            'product_slug'  => Str::slug($nameString),
            'id_categories' => rand(1,4),
            'price'         => rand(10000,1000000),
            'description'   => fake()->paragraph(),
            'tags'          => ''
        ];
    }
}
