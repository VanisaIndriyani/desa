<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('facilities', function (Blueprint $table) {
            if (! Schema::hasColumn('facilities', 'gambar_path')) {
                $table->string('gambar_path')->nullable()->after('gambar_url');
            }
        });
    }

    public function down(): void
    {
        Schema::table('facilities', function (Blueprint $table) {
            if (Schema::hasColumn('facilities', 'gambar_path')) {
                $table->dropColumn('gambar_path');
            }
        });
    }
};
