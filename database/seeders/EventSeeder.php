<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


/*
  category_id ID List
  mapping from CategorySeeder
  1 = Music
  2 = Art
  3 = Festival
  4 = Food
  5 = Movie
  6 = Kids
  7 = Fashion
*/

class EventSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // \App\Models\Event::factory(250)->create();

    $list = [];
    array_push($list, [
      'data' => EventDummyData\MusicData::$data,
      'category_id' => EventDummyData\MusicData::$category_id
    ]);
    array_push($list, [
      'data' => EventDummyData\ArtData::$data,
      'category_id' => EventDummyData\ArtData::$category_id
    ]);
    array_push($list, [
      'data' => EventDummyData\FestivalData::$data,
      'category_id' => EventDummyData\FestivalData::$category_id
    ]);
    array_push($list, [
      'data' => EventDummyData\FoodData::$data,
      'category_id' => EventDummyData\FoodData::$category_id
    ]);
    array_push($list, [
      'data' => EventDummyData\MovieData::$data,
      'category_id' => EventDummyData\MovieData::$category_id
    ]);
    array_push($list, [
      'data' => EventDummyData\KidsData::$data,
      'category_id' => EventDummyData\KidsData::$category_id
    ]);
    array_push($list, [
      'data' => EventDummyData\FashionData::$data,
      'category_id' => EventDummyData\FashionData::$category_id
    ]);

    foreach ($list as &$dataByCategory) {
      foreach ($dataByCategory['data'] as &$item) {
        \App\Models\Event::create([
          'title' => $item['title'],
          'description' => $item['description'],
          'start_at' => $item['start_at'],
          'end_at' => $item['end_at'],
          'venue' => $item['venue'],
          'lat' => $item['lat'],
          'lng' => $item['lng'],
          'image_url' => $item['image_url'],
          'category_id' => $dataByCategory['category_id'],
        ]);
      }
    }
  }
}