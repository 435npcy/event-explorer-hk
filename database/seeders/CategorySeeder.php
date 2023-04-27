<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    \App\Models\Category::create(['name' => 'Music']);
    \App\Models\Category::create(['name' => 'Art']);
    \App\Models\Category::create(['name' => 'Festival']);
    \App\Models\Category::create(['name' => 'Food']);
    \App\Models\Category::create(['name' => 'Movie']);
    \App\Models\Category::create(['name' => 'Kids']);
    \App\Models\Category::create(['name' => 'Fashion']);
  }
}