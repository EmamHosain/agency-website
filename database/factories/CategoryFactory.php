<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'category_name' => $this->faker->unique()->word(),
            'slug' => Str::slug($this->faker->unique()->word()),
            'status' => $this->faker->randomElement([0, 1]), // 0 = inactive, 1 = active
        ];
    }
}
