<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus data lama
        DB::table('tags')->delete();

        // Masukkan data tags
        DB::table('tags')->insert([
            ['blog_id' => "1",'name_tag' => 'KomunitasMuda'],
            ['blog_id' => "1",'name_tag' => 'TelkomselCOMMUNAL'],
            ['blog_id' => "1",'name_tag' => 'EkosistemDigital'],
            ['blog_id' => "1",'name_tag' => 'YouthMovement'],
        ]);
    }
}
