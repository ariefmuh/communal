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
            'nama_pic' => 'superuser',
            'no_wa' => '081240907134',
            'alamat' => 'Pesona Taman Dahlia 2 A17',
            'role' => "superuser",
            'category' => "Programming",
            'email' => 'muharief5678@gmail.com',
            'password' => Hash::make('superuser'), // Enkripsi password 'superuser'
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'test',
            'nama_pic' => 'test',
            'no_wa' => '0123456789',
            'alamat' => 'The Earth',
            'role' => "guest",
            'category' => "",
            'email' => 'example@gmail.com',
            'password' => Hash::make('testing123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Team Leader',
            'nama_pic' => 'Team Leader',
            'no_wa' => '0123456789',
            'alamat' => 'The Earth',
            'role' => "TL",
            'category' => "Arts",
            'email' => 'leader@gmail.com',
            'password' => Hash::make('testing123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
