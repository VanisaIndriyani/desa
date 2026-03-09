<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('letters', function (Blueprint $table) {
            if (! Schema::hasColumn('letters', 'file_path')) {
                $table->string('file_path')->nullable()->after('nomor_surat');
            }
        });

        Schema::table('complaints', function (Blueprint $table) {
            if (! Schema::hasColumn('complaints', 'tanggapan')) {
                $table->text('tanggapan')->nullable()->after('status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('letters', function (Blueprint $table) {
            if (Schema::hasColumn('letters', 'file_path')) {
                $table->dropColumn('file_path');
            }
        });

        Schema::table('complaints', function (Blueprint $table) {
            if (Schema::hasColumn('complaints', 'tanggapan')) {
                $table->dropColumn('tanggapan');
            }
        });
    }
};
