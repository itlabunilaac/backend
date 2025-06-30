<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jurnal;

class JurnalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jurnals = [
            [
                'judul' => 'Implementasi Machine Learning dalam Bidang Kesehatan',
                'deskripsi' => 'Penelitian ini membahas penerapan teknologi machine learning untuk diagnosis dini penyakit berdasarkan data medis pasien.',
                'akreditasi' => 'Sinta 2',
                'link_akreditasi' => 'https://sinta.ristekbrin.go.id',
                'subject' => 'Teknologi Informasi',
                'penerbit' => 'Jurnal Teknologi Kesehatan',
                'link_penerbit' => 'https://example.com/jurnal-teknologi-kesehatan',
                'views' => 150,
            ],
            [
                'judul' => 'Analisis Kualitas Air Sungai dengan Metode Spektrofotometri',
                'deskripsi' => 'Studi komprehensif tentang kualitas air sungai di daerah industri menggunakan metode spektrofotometri untuk deteksi polutan.',
                'akreditasi' => 'Sinta 1',
                'link_akreditasi' => 'https://sinta.ristekbrin.go.id',
                'subject' => 'Lingkungan',
                'penerbit' => 'Jurnal Lingkungan Indonesia',
                'link_penerbit' => 'https://example.com/jurnal-lingkungan',
                'views' => 200,
            ],
            [
                'judul' => 'Optimasi Algoritma Genetika untuk Penjadwalan Produksi',
                'deskripsi' => 'Penelitian tentang penggunaan algoritma genetika dalam mengoptimalkan jadwal produksi di industri manufaktur.',
                'akreditasi' => 'Sinta 3',
                'link_akreditasi' => 'https://sinta.ristekbrin.go.id',
                'subject' => 'Teknik Industri',
                'penerbit' => 'Jurnal Teknik Industri Indonesia',
                'link_penerbit' => 'https://example.com/jurnal-teknik-industri',
                'views' => 95,
            ],
            [
                'judul' => 'Pengembangan Aplikasi Mobile untuk Monitoring Pertanian',
                'deskripsi' => 'Desain dan implementasi aplikasi mobile untuk membantu petani dalam monitoring kondisi tanaman dan cuaca.',
                'akreditasi' => 'Sinta 2',
                'link_akreditasi' => 'https://sinta.ristekbrin.go.id',
                'subject' => 'Teknologi Informasi',
                'penerbit' => 'Jurnal Informatika Pertanian',
                'link_penerbit' => 'https://example.com/jurnal-informatika-pertanian',
                'views' => 180,
            ],
            [
                'judul' => 'Studi Ekonomi Mikro pada UMKM di Era Digital',
                'deskripsi' => 'Analisis dampak digitalisasi terhadap perkembangan usaha mikro, kecil, dan menengah (UMKM) di Indonesia.',
                'akreditasi' => 'Sinta 1',
                'link_akreditasi' => 'https://sinta.ristekbrin.go.id',
                'subject' => 'Ekonomi',
                'penerbit' => 'Jurnal Ekonomi Pembangunan',
                'link_penerbit' => 'https://example.com/jurnal-ekonomi',
                'views' => 320,
            ],
        ];

        foreach ($jurnals as $jurnal) {
            Jurnal::create($jurnal);
        }
    }
}
