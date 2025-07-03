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
        // Panggil seeder lain dari sini
        $this->call([
            UsersTableSeeder::class,
            TagsTableSeeder::class,
            BlogsTableSeeder::class,
            SectionSeeder::class,
            HomepageSeeder::class,
            CategorySeeder::class,
        ]);
    }
}
