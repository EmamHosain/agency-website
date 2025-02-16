<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Article::class;

    public function definition(): array
    {
        return [
            'category_id' => Category::inRandomOrder()->first()->id, // Random category
            'title' => $this->faker->sentence,
            'slug' => Str::slug($this->faker->sentence),
            'author_name' => $this->faker->name,
            'content' => $this->faker->paragraph,
            'article_image' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement([1, 0]), // Active or Inactive
        ];
    }
}
