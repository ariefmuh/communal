<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'superuser',
            'email' => 'superuser@gmail.com',
            'role' => '0',
            'password' => '$2y$10$aUatjBm6ifqwa.7Gkbw.wuGvttSqkC.3gjF2te/xjtKabwWw.f.r.',
        ]);
    }
}
