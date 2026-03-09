<?php

namespace Database\Seeders;

use App\Models\Statistic;
use Illuminate\Database\Seeder;

class StatisticsSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['nama' => 'Jumlah Penduduk', 'kategori' => 'Demografi', 'unit' => 'Jiwa', 'nilai' => 1250, 'urut' => 1, 'published' => true],
            ['nama' => 'RT', 'kategori' => 'Administratif', 'unit' => 'Unit', 'nilai' => 5, 'urut' => 2, 'published' => true],
            ['nama' => 'RW', 'kategori' => 'Administratif', 'unit' => 'Unit', 'nilai' => 2, 'urut' => 3, 'published' => true],
            ['nama' => 'Anggaran Tahun Ini', 'kategori' => 'Keuangan', 'unit' => 'Juta', 'nilai' => 850.00, 'urut' => 10, 'published' => true],
            ['nama' => 'Luas Wilayah', 'kategori' => 'Geografis', 'unit' => 'km²', 'nilai' => 12.5, 'urut' => 4, 'published' => true],
        ];

        foreach ($rows as $row) {
            Statistic::updateOrCreate(
                ['nama' => $row['nama']],
                $row
            );
        }
    }
}
