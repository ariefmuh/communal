<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus data lama untuk menghindari duplikat jika seeder dijalankan lagi
        DB::table('users')->delete();

        // Masukkan data user baru
        DB::table('users')->insert([
            'name' => 'superuser',
            'role' => 0, // 0 untuk superuser
            'email' => 'muharief5678@gmail.com',
            'password' => Hash::make('superuser'), // Enkripsi password 'superuser'
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
