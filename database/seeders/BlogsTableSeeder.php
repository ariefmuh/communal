<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus data lama
        DB::table('blogs')->delete();

        // Masukkan data blog
        DB::table('blogs')->insert([
            'title' => 'Komunitas Muda, Motor Perubahan di Era Digital',
            'author' => 'Test',
            'picture' => 'blog1.jpg',
            'opening' => 'Komunitas Muda, Motor Perubahan di Era Digital. Di era digital yang serba cepat ini, anak muda tidak hanya menjadi pengguna teknologi—mereka adalah penggerak utama perubahan. Di balik tren viral, kampanye sosial, dan inisiatif-inisiatif kreatif, ada satu kekuatan yang bekerja secara senyap namun masif: komunitas.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
