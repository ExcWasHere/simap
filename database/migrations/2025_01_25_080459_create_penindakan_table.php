<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('penindakan', function (Blueprint $table) {
            $table->id();
            $table->string('no_sbp');
            $table->date('tanggal_sbp');
            $table->string('lokasi_penindakan');
            $table->string('pelaku');
            $table->text('uraian_bhp');
            $table->integer('jumlah');
            $table->string('kemasan')->nullable();
            $table->integer('perkiraan_nilai_barang');
            $table->integer('potensi_kurang_bayar');
            $table->enum('status', ['open', 'processed', 'closed'])->default('open');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['no_sbp', 'deleted_at'], 'penindakan_no_sbp_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penindakan');
    }
};