<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;



class TicketTypeSeeder extends Seeder
{

  public static $sets = [
    [
      [
        'name' => 'Audit',
        'price' => 580.00,
      ],
      [
        'name' => 'Youth',
        'price' => 280.00,
      ],
    ],
    [
      [
        'name' => 'Audit',
        'price' => 200.00,
      ],
      [
        'name' => 'Student',
        'price' => 100.00,
      ],
      [
        'name' => 'Child/Elder',
        'price' => 50.00,
      ],
    ],
    [
      [
        'name' => 'VIP',
        'price' => 1000.00,
      ],
      [
        'name' => 'General',
        'price' => 780.00,
      ],
    ],
    [
      [
        'name' => 'All day pass',
        'price' => 20.00,
      ],
    ],
    [
      [
        'name' => 'Free',
        'price' => 0.00,
      ],
    ],
  ];
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $events = \App\Models\Event::all();

    $index = 0;
    foreach ($events as &$event) {
      $base = count($this::$sets);
      // $index = fmod($value, $base);
      $set = $this::$sets[fmod($index, $base)];
      foreach ($set as &$item) {
        \App\Models\TicketType::create([
          'name' => $item['name'],
          'price' => $item['price'],
          'event_id' => $event->id,
        ]);
      }
      $index++;
    }
  }
}