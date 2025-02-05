<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('intelijen', function (Blueprint $table) {
            $table->id();
            $table->string('no_nhi')->unique();
            $table->date('tanggal_nhi');
            $table->string('tempat');
            $table->string('jenis_barang');
            $table->integer('jumlah_barang');
            $table->enum('kemasan', ['liter', 'batang']);
            $table->text('keterangan')->nullable();
            $table->enum('status', ['open', 'processed', 'closed'])->default('open');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('intelijen');
    }
};