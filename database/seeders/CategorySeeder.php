<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->delete();

        // Masukkan data tags
        DB::table('category')->insert([
            ['category_name' => "Superuser"],
            ['category_name' => "Art"],
            ['category_name' => "Sport"],
            ['category_name' => "Forum Diskusi"],
            ['category_name' => "Books"],
            ['category_name' => "Adventure"],
        ]);
    }
}
