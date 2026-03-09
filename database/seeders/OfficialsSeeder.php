<?php

namespace Database\Seeders;

use App\Models\Official;
use Illuminate\Database\Seeder;

class OfficialsSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['nama' => 'Nama Kepala Desa', 'jabatan' => 'Kepala Desa', 'urut' => 1, 'published' => true],
            ['nama' => 'Nama Sekretaris', 'jabatan' => 'Sekretaris Desa', 'urut' => 2, 'published' => true],
            ['nama' => 'Nama Kaur', 'jabatan' => 'Kaur Pelayanan', 'urut' => 3, 'published' => true],
            ['nama' => 'Nama Kasi', 'jabatan' => 'Kasi Ketertiban', 'urut' => 4, 'published' => true],
        ];
        foreach ($rows as $row) {
            Official::updateOrCreate(
                ['jabatan' => $row['jabatan']],
                $row
            );
        }
    }
}
