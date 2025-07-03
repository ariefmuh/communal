<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomepageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus data lama
        DB::table("homepages")->delete();

        // Masukkan data homepage
        DB::table("homepages")->insert([
            ["name" => "about", "title" => "About us", "picture" => "", "link" => "","description" => "Telkomsel menghadirkan COMMUNAL, sebuah inisiatif untuk merangkul komunitas-komunitas muda di seluruh Kalimantan, Sulawesi, Maluku, dan Papua. Melalui program ini, komunitas terpilih akan mendapatkan dukungan kegiatan, akses kolaborasi, hingga platform digital untuk berkembang bersama.

            <br><br>COMMUNAL hadir bukan untuk mengambil alih arah komunitas, tapi untuk menjadi jembatan. Jembatan menuju eksposur lebih luas, penguatan kapasitas, dan dampak sosial yang lebih nyata."],
            ["name" => "about_extra", "title" => "Aktivitas Kolaboratif :", "picture" => "", "link" => "","description" => "Kegiatan komunitas dalam kategori seni, olahraga, edukasi, pengembangan diri, sosial, hobi, dan digital movement."],

            ["name" => "about_extra", "title" => "Evaluasi Berkala :", "picture" => "", "link" => "","description" => "Kerjasama dilakukan selama 6 bulan dengan evaluasi per 3 bulan untuk menilai dampak, keberlanjutan, dan efektivitas kolaborasi."],

            ["name" => "about_extra", "title" => "Digital Integration :", "picture" => "", "link" => "","description" => "Penggunaan platform digital seperti media sosial, website, dan aplikasi untuk publikasi, pelaporan, dan aktivasi komunitas."],

            ["name" => "brand_affiliation_extra", "title" => "Kuncie","picture" => "kuncieLogo.png","link" => "https://kuncie.com/","description" => "Kuncie merupakan startup digital yang bergerak di bidang edukasi dan penyelesaian masalah sosial."],

            ["name" => "brand_affiliation_extra", "title" => "By U","picture" => "Byu-logo.png","link" => "https://www.telkomsel.com/byU","description" => "layanan seluler prabayar digital dari Telkomsel yang menawarkan pengalaman serba digital bagi penggunanya. Dengan by.U, pengguna dapat memilih nomor, menentukan kuota internet, mengelola akun, dan melakukan pembayaran melalui aplikasi."],

            ["name" => "brand_affiliation_extra", "title" => "SimPATI","picture" => "SimPATI.png","link" => "https://www.telkomsel.com/SIMPATI","description" => "produk kartu SIM prabayar dari Telkomsel yang sempat menjadi produk utama sebelum akhirnya dilebur menjadi Telkomsel Prabayar pada tahun 2021."],

            ["name" => "brand_affiliation_extra", "title" => "Skul id","picture" => "skulLogo.png","link" => "https://skul.id/","description" => "Aplikasi online sebagai solusi atas kebutuhan kegiatan belajar dan administrasi secara digital dalam lingkungan sekolah. Beragam fitur dapat digunakan untuk mempermudah kegiatan belajar mengajar seperti absensi online, pembayaran SPP, kelas online, Kuis Online, Nilai dan lainnya."],

            ["name" => "brand_affiliation_extra", "title" => "Ilmupedia","picture" => "IlmupediaLogo.png","link" => "https://www.ilmupedia.co.id/","description" => "Ilmupedia adalah paket internet khusus yang disediakan oleh Telkomsel untuk mendukung aktivitas belajar siswa dan mahasiswa, dengan memberikan akses ke berbagai platform dan aplikasi pendidikan online"],

            ["name" => "portofolio_extra", "title" => "Logo Telkomsel","picture" => "LogoTelkomsel.png","link" => "https://maxsi.id/web/assets/logo-telkomsel-baru.DYhv_uL8_1T5nit.webp","description" => "Logo Telkomsel"],
        ]);
    }
}
