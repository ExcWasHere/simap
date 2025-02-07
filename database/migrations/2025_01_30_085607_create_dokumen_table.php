<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dokumen', function (Blueprint $table) {
            $table->id();
            $table->enum('tipe', [
                // Intelijen
                'ST-I', 'LPTI', 'LPPI', 'LKAI', 'NHI', 'NI',
                // Penyidikan
                'LK', 'SPTP', 'SPDP', 'TAP SITA', 'P2I',
                // Monitoring
                'KEP-BDN', 'KEP-BMN', 'KEP-UR', 'SCTK',
                // Penindakan
                'PRIN', 'ST', 'BA-Pemeriksaan', 'BA-Penegahan', 'BAST',
                'BA-Dokumentasi', 'BA-Pencacahan', 'BA-Penyegelan', 'SBP',
                'LPHP', 'LP/LP1', 'LPP', 'LPF', 'SPLIT', 'LHP', 'LRP'
            ]);
            $table->text('deskripsi')->nullable();
            $table->string('file_path');
            $table->string('reference_id')->nullable();
            $table->foreignId('uploaded_by')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumen');
    }
};