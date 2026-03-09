<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('content_pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('judul');
            $table->longText('isi')->nullable();
            $table->timestamps();
        });

        DB::table('content_pages')->insert([
            ['slug' => 'beranda', 'judul' => 'Beranda Desa', 'isi' => null, 'created_at' => now(), 'updated_at' => now()],
            ['slug' => 'profil', 'judul' => 'Profil Desa', 'isi' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('content_pages');
    }
};
