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
        // Hapus data lama dan reset auto increment
        DB::table('blogs')->delete();
        DB::statement('ALTER TABLE blogs AUTO_INCREMENT = 1');

        // Masukkan data blog
        DB::table('blogs')->insert([
            [
                'user_id' => '1',
                'title' => 'Komunitas Muda, Motor Perubahan di Era Digital',
                'author' => 'Test',
                'picture' => 'blog1.jpg',
                'opening' => 'Komunitas Muda, Motor Perubahan di Era Digital. Di era digital yang serba cepat ini, anak muda tidak hanya menjadi pengguna teknologi—mereka adalah penggerak utama perubahan. Di balik tren viral, kampanye sosial, dan inisiatif-inisiatif kreatif, ada satu kekuatan yang bekerja secara senyap namun masif: komunitas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '1',
                'title' => 'Membangun Jaringan Sosial yang Sehat di Lingkungan Komunitas',
                'author' => 'Test',
                'picture' => 'blog2.jpg',
                'opening' => 'Membangun Jaringan Sosial yang Sehat di Lingkungan Komunitas. Dalam kehidupan modern, memiliki jaringan sosial yang kuat dan sehat menjadi kunci penting untuk perkembangan personal dan profesional. Komunitas lokal berperan vital dalam menciptakan lingkungan yang mendukung tumbuhnya hubungan-hubungan bermakna antar individu.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
