<?php

namespace Database\Seeders;

use App\Models\ContentPage;
use Illuminate\Database\Seeder;

class ContentPageSeeder extends Seeder
{
    public function run(): void
    {
        ContentPage::updateOrCreate(
            ['slug' => 'beranda'],
            [
                'judul' => 'Beranda Desa',
                'isi' => '<p>Selamat datang di portal Desa RAKU.</p>',
            ]
        );

        ContentPage::updateOrCreate(
            ['slug' => 'profil'],
            [
                'judul' => 'Profil Desa',
                'isi' => '<p>Profil singkat Desa RAKU dapat diedit dari halaman admin.</p>',
            ]
        );

        ContentPage::updateOrCreate(
            ['slug' => 'visi-misi'],
            [
                'judul' => 'Visi & Misi',
                'isi' => '<h5>Visi</h5><p>Desa maju, mandiri, sejahtera.</p><h5>Misi</h5><ul><li>Peningkatan pelayanan.</li><li>Digitalisasi layanan.</li></ul>',
            ]
        );
    }
}
