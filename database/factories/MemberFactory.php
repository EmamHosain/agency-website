<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Member::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'designation' => $this->faker->jobTitle(),
            'fb_url' => $this->faker->optional()->url(),
            'inst_url' => $this->faker->optional()->url(),
            'twi_url' => $this->faker->optional()->url(),
            'image' =>  $this->faker->image(200, 200, null, false),
            'status' => $this->faker->randomElement([0, 1]), // 0 = inactive, 1 = active
        ];
    }
}
