<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->delete();
        DB::statement('ALTER TABLE sections AUTO_INCREMENT = 1');

        // Masukkan data
        DB::table('sections')->insert([
            ['blog_id' => '1', 'title' => '🌱 Apa Itu Komunitas Muda di Era Sekarang?', 'description' => 'Komunitas muda bukan lagi sekadar kumpulan orang dengan hobi sama. Ia telah berevolusi menjadi ruang tumbuh, tempat bertukar ide, saling belajar, hingga menciptakan solusi bagi isu-isu di sekitar. Mulai dari komunitas seni, olahraga, edukasi, teknologi, hingga sosial—semuanya menjadi wajah baru dari pergerakan generasi muda masa kini.

Mereka membangun dari bawah, dari kampus, sekolah, ruang virtual, hingga pojok kota. Tidak menunggu panggung, mereka menciptakan panggungnya sendiri.
'],
            ['blog_id' => '1', 'title' => '📶 Koneksi Digital, Akselerator Kolaborasi', 'description' => 'Kemajuan teknologi dan konektivitas memungkinkan komunitas untuk berkembang lebih cepat dari sebelumnya. Melalui media sosial, platform kolaboratif, dan komunikasi real-time, komunitas muda kini bisa menjangkau ribuan orang dalam waktu singkat—bahkan lintas kota, provinsi, hingga negara.

Namun di balik layar, semua itu tetap berakar pada hal yang sederhana: relasi dan nilai bersama.
'],
            ['blog_id' => '1', 'title' => '💥 Mengapa Komunitas Muda Punya Daya Ubah Besar?', 'description' => 'Autentik dan Relevan:
Anak muda berbicara dengan bahasa mereka sendiri. Ketika komunitas berbicara, audiens mendengarkan—karena itu suara yang nyata, bukan sekadar iklan.
Cepat Beradaptasi:
Komunitas muda cepat menyesuaikan diri dengan tren dan isu. Mereka lincah, kreatif, dan berani mencoba pendekatan baru.
Punya Jaringan yang Solid:
Kepercayaan di antara anggota komunitas menciptakan efek bola salju: pesan menyebar lebih kuat dan bertahan lebih lama.
Bukan Cuma Bersuara, Tapi Bertindak:
Dari gerakan peduli lingkungan, kampanye kesehatan mental, hingga edukasi teknologi—komunitas muda tidak hanya bicara, tapi juga turun tangan.
'],
            ['blog_id' => '1', 'title' => '🔗 COMMUNAL: Ruang Baru Kolaborasi Anak Muda', 'description' => 'Melihat potensi tersebut, Telkomsel menghadirkan COMMUNAL, sebuah inisiatif untuk merangkul komunitas-komunitas muda di seluruh Kalimantan, Sulawesi, Maluku, dan Papua. Melalui program ini, komunitas terpilih akan mendapatkan dukungan kegiatan, akses kolaborasi, hingga platform digital untuk berkembang bersama.

COMMUNAL hadir bukan untuk mengambil alih arah komunitas, tapi untuk menjadi jembatan. Jembatan menuju eksposur lebih luas, penguatan kapasitas, dan dampak sosial yang lebih nyata.
'],

            ['blog_id' => '1', 'title' => '✨ Kesimpulan: Komunitas Adalah Ekosistem Masa Depan', 'description' => 'Anak muda butuh ruang untuk bergerak, bukan hanya panggung untuk dilihat. Komunitas adalah ruang itu. Di sana mereka bisa menjadi diri sendiri, berbagi ide, dan menciptakan perubahan.

Dan saat komunitas bertemu dengan kolaborator yang tepat—seperti COMMUNAL dari Telkomsel—maka perubahan bukan hanya mungkin, tapi pasti terjadi.

Yuk, tumbuh dan bergerak bersama!
🔗 Daftarkan komunitasmu ke COMMUNAL sekarang
'],

            // Sections for Blog 2
            ['blog_id' => '2', 'title' => '🤝 Pentingnya Membangun Hubungan yang Bermakna', 'description' => 'Jaringan sosial yang sehat dimulai dari fondasi hubungan yang tulus dan bermakna. Bukan hanya sekadar mengenal nama atau wajah, tetapi memahami nilai, visi, dan tujuan bersama.

Dalam komunitas, setiap individu membawa keunikan dan perspektif yang berbeda. Ketika kita dapat menghargai perbedaan ini dan menemukan titik temu, maka tercipta sinergi yang kuat untuk mencapai tujuan bersama.
'],

            ['blog_id' => '2', 'title' => '🌐 Membangun Kepercayaan dalam Komunitas', 'description' => 'Kepercayaan adalah mata uang utama dalam setiap hubungan sosial. Tanpa kepercayaan, komunitas hanya akan menjadi sekumpulan individu tanpa ikatan yang kuat.

Membangun kepercayaan membutuhkan konsistensi dalam tindakan, transparansi dalam komunikasi, dan komitmen untuk saling mendukung. Ketika anggota komunitas merasa aman dan dipercaya, mereka akan lebih terbuka untuk berbagi ide, pengalaman, dan sumber daya.
'],

            ['blog_id' => '2', 'title' => '💬 Komunikasi Efektif sebagai Kunci Utama', 'description' => 'Komunikasi yang efektif tidak hanya tentang menyampaikan pesan dengan jelas, tetapi juga tentang mendengarkan dengan empati dan memahami perspektif orang lain.

Dalam komunitas yang sehat, setiap suara dihargai dan setiap pendapat didengarkan. Konflik tidak dihindari, tetapi diselesaikan melalui dialog yang konstruktif dan solusi yang menguntungkan semua pihak.
'],

            ['blog_id' => '2', 'title' => '🎯 Menciptakan Tujuan dan Visi Bersama', 'description' => 'Komunitas yang kuat memiliki tujuan dan visi yang jelas. Hal ini memberikan arah dan motivasi bagi setiap anggota untuk berkontribusi secara maksimal.

Proses penciptaan visi bersama harus melibatkan semua anggota komunitas. Setiap orang harus merasa memiliki dan bertanggung jawab terhadap pencapaian tujuan tersebut. Dengan begitu, komitmen dan dedikasi akan tumbuh secara alami.
'],

            ['blog_id' => '2', 'title' => '🌱 Mendukung Pertumbuhan dan Perkembangan Anggota', 'description' => 'Komunitas yang sehat adalah tempat di mana setiap anggota dapat tumbuh dan berkembang. Ini berarti menciptakan lingkungan yang mendukung pembelajaran, berbagi pengetahuan, dan pengembangan keterampilan.

Mentoring, workshop, dan kolaborasi proyek adalah beberapa cara efektif untuk mendukung pertumbuhan anggota. Ketika setiap individu berkembang, komunitas secara keseluruhan juga akan mengalami kemajuan.
'],

            ['blog_id' => '2', 'title' => '🌟 Kesimpulan: Investasi Jangka Panjang untuk Masa Depan', 'description' => 'Membangun jaringan sosial yang sehat dalam komunitas bukanlah pekerjaan yang dapat diselesaikan dalam semalam. Ini adalah investasi jangka panjang yang membutuhkan komitmen, kesabaran, dan dedikasi dari semua pihak.

Namun, hasil dari investasi ini sangatlah berharga: komunitas yang solid, hubungan yang bermakna, dan dampak positif yang berkelanjutan. Mari kita mulai membangun jaringan sosial yang sehat di komunitas kita masing-masing!
'],
        ]);
    }
}
