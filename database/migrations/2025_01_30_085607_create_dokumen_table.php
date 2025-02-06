<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dokumen', function (Blueprint $table) {
            $table->id();
            $table->enum('tipe', ['ST-I', 'LPTI', 'LPPI', 'LKAI', 'NHI', 'NI', 'LK', 'SPTP', 'SPDP', 'TAP-SITA', 'P2I', 'KEP-BDN', 'KEP-BMN', 'KEP-UR', 'SCTK']);
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