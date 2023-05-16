<?php

namespace Database\Factories\Api\V1;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Api\V1\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(3,true),
            'body' => fake()->sentence(50),
            'user_id' => rand(1,15),
            'published_at' => Carbon::today()->subDays(rand(0,30))->toDateTimeString()
        ];
    }
}
