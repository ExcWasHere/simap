<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penindakan', function (Blueprint $table) {
            $table->id();
            $table->string('no_sbp')->unique();
            $table->date('tanggal_sbp');
            $table->string('lokasi_penindakan');
            $table->string('pelaku');
            $table->text('uraian_bhp');
            $table->integer('jumlah');
            $table->string('kemasan')->nullable();
            $table->integer('perkiraan_nilai_barang');
            $table->integer('potensi_kurang_bayar');
            $table->foreignId('intelijen_id')->constrained('intelijen');
            $table->enum('status', ['open', 'processed', 'closed'])->default('open');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penindakan');
    }
};
