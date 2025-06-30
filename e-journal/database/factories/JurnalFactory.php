<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jurnal>
 */
class JurnalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subjects = ['Teknologi Informasi', 'Teknik Industri', 'Ekonomi', 'Lingkungan', 'Kesehatan', 'Pendidikan'];
        $akreditasi = ['Sinta 1', 'Sinta 2', 'Sinta 3', 'Sinta 4', 'Scopus', 'Web of Science'];
        $penerbit = [
            'Jurnal Teknologi Indonesia',
            'Jurnal Ilmu Komputer',
            'Jurnal Ekonomi Pembangunan',
            'Jurnal Lingkungan Indonesia',
            'Jurnal Kesehatan Masyarakat',
            'Jurnal Pendidikan Indonesia'
        ];

        return [
            'judul' => $this->faker->sentence(8),
            'deskripsi' => $this->faker->paragraph(3),
            'akreditasi' => $this->faker->randomElement($akreditasi),
            'link_akreditasi' => $this->faker->url(),
            'subject' => $this->faker->randomElement($subjects),
            'penerbit' => $this->faker->randomElement($penerbit),
            'link_penerbit' => $this->faker->url(),
            'views' => $this->faker->numberBetween(0, 1000),
        ];
    }
}
