<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    $category = $this->faker->randomElement(\App\Models\Category::all());

    $start = fake()->dateTimeBetween('-30 days', '+30 days');
    return [
      'title' => rand(0, 1) ? fake()->sentence(rand(1, 8)) : fake()->sentences(rand(2, 3), true),
      // 'description' => fake()->text,
      'description' => fake()->paragraphs(rand(5, 15), true),
      'start_at' => $start,
      'end_at' => Carbon::parse($start)->addDays(rand(1, 7)),
      'venue' => fake()->address,
      'lat' => fake()->latitude(22.1782171, 22.5282171),
      'lng' => fake()->longitude(113.853479, 114.362765),
      'category_id' => $category,
      'image_url' => fake()->imageUrl(640, 480, $category->name, true),
    ];
  }
}