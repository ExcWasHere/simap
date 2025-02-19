<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('penindakan', function (Blueprint $table) {
            $table->id();
            
            // Data SBP (Surat Bukti Penindakan)
            $table->string('no_sbp');
            $table->date('tanggal_sbp');
            $table->date('tanggal_laporan');
            $table->string('no_print');
            $table->date('tanggal_print');
            
            // Informasi Barang
            $table->string('jenis_barang');
            $table->text('uraian_bhp');
            $table->integer('jumlah');
            $table->enum('kemasan', ['batang', 'liter']);
            $table->integer('perkiraan_nilai_barang');
            $table->integer('potensi_kurang_bayar');
            
            // Lokasi dan Waktu Penindakan
            $table->string('lokasi_penindakan');
            $table->datetime('waktu_awal_penindakan');
            $table->datetime('waktu_akhir_penindakan');
            
            // Informasi Sarana Pengangkut
            $table->string('nama_jenis_sarkut');
            $table->string('pengemudi');
            $table->string('no_polisi');
            $table->string('bangunan');
            
            // Data Pelaku
            $table->string('pelaku');
            $table->string('nama_pemilik');
            $table->string('no_ktp');
            $table->string('no_hp');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir'); 
            $table->string('pekerjaan');
            $table->text('alamat');
            
            // Informasi Pelanggaran
            $table->string('jenis_pelanggaran');
            $table->string('pasal');
            
            // Data Petugas
            $table->string('petugas_1');
            $table->string('petugas_2');
            
            // Tanda Tangan
            $table->string('ttd_pelaku')->nullable();
            $table->text('ttd_petugas_1')->nullable();
            $table->text('ttd_petugas_2')->nullable();
            
            // System Fields
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