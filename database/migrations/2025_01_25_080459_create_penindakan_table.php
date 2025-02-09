<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('penindakan', function (Blueprint $table) {
            $table->id();
            $table->string('no_sbp');
            $table->date('tanggal_sbp');
            $table->date('tanggal_laporan');
            $table->string('lokasi_penindakan');
            $table->string('pelaku');
            $table->text('uraian_bhp');
            $table->integer('jumlah');
            $table->enum('kemasan', ['batang', 'liter']);
            $table->integer('perkiraan_nilai_barang');
            $table->integer('potensi_kurang_bayar');
            $table->string('jenis_barang');
            $table->string('no_print');
            $table->date('tanggal_print');
            $table->string('nama_jenis_sarkut');
            $table->string('pengemudi');
            $table->string('no_polisi');
            $table->string('bangunan');
            $table->string('nama_pemilik');
            $table->string('no_ktp');
            $table->string('no_hp');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('pekerjaan');
            $table->text('alamat');
            $table->datetime('waktu_awal_penindakan');
            $table->datetime('waktu_akhir_penindakan');
            $table->string('jenis_pelanggaran');
            $table->string('pasal');
            $table->string('petugas_1');
            $table->string('petugas_2');
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