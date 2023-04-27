<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $roleAdmin = \App\Models\Role::where('name', \App\Models\Role::ADMIN)->get();
    $roleMember = \App\Models\Role::where('name', \App\Models\Role::MEMBER)->get();

    $admin1 = \App\Models\User::factory(1)
      ->hasAttached($roleAdmin)
      ->create([
        'name' => 'Pan',
        'email' => 'pan@pan.io'
      ]);

    \App\Models\User::factory(1)
      ->hasAttached($roleAdmin)
      ->create([
        'name' => 'Admin 2',
        'email' => 'admin2@example.com'
      ]);

    \App\Models\User::factory(1)
      ->hasAttached($roleAdmin)
      ->create([
        'name' => 'Admin 3',
        'email' => 'admin3@example.com'
      ]);

    \App\Models\User::factory(1)
      ->hasAttached($roleMember)
      ->create([
        'name' => 'Member 1',
        'email' => 'member@example.com'
      ]);

    \App\Models\User::factory(1)
      ->hasAttached($roleMember)
      ->create([
        'name' => 'Member 2',
        'email' => 'member2@example.com'
      ]);

    \App\Models\User::factory(10)
      ->hasAttached($roleMember)
      ->create();

  }
}