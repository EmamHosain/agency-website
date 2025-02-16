<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Service::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'icon_class' => $this->faker->randomElement(['fa-user', 'fa-cog', 'fa-star']),
            'short_desc' => $this->faker->text(50),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement([0, 1]), // 0 = inactive, 1 = active
        ];
    }
}
