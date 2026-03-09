<?php

namespace Database\Seeders;

use App\Models\Facility;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ContentPageSeeder::class,
            StatisticsSeeder::class,
            OfficialsSeeder::class,
        ]);

        User::query()->updateOrCreate(
            ['email' => 'admin@desa.local'],
            [
                'name' => 'Admin Desa',
                'password' => Hash::make('admin123'),
                'nik' => 'ADM0000000000',
                'phone' => '0800000000',
                'role' => 'admin',
            ]
        );
        User::query()->updateOrCreate(
            ['email' => 'warga@desa.local'],
            [
                'name' => 'Warga Contoh',
                'password' => Hash::make('warga123'),
                'nik' => '3200000000000001',
                'phone' => '081234567890',
                'role' => 'warga',
            ]
        );
        Facility::query()->updateOrCreate(['nama' => 'Gedung Serbaguna'], [
            'deskripsi' => 'Untuk acara besar, rapat, olahraga indoor.',
            'kapasitas' => 500,
            'gambar_url' => 'https://via.placeholder.com/600x350?text=Gedung+Serbaguna',
        ]);
        Facility::query()->updateOrCreate(['nama' => 'Lapangan Desa'], [
            'deskripsi' => 'Lapangan outdoor sepak bola dan voli.',
            'kapasitas' => 200,
            'gambar_url' => 'https://via.placeholder.com/600x350?text=Lapangan+Desa',
        ]);
        Facility::query()->updateOrCreate(['nama' => 'Peralatan Pesta'], [
            'deskripsi' => 'Tenda, kursi, sound system untuk hajatan.',
            'kapasitas' => 100,
            'gambar_url' => 'https://via.placeholder.com/600x350?text=Peralatan+Pesta',
        ]);
    }
}
