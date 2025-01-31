<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penyidikan', function (Blueprint $table) {
            $table->id();
            $table->string('no_spdp');
            $table->date('tanggal_spdp');
            $table->string('pelaku');
            $table->text('keterangan')->nullable();
            $table->foreignId('intelijen_id')->constrained('intelijen');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['no_spdp', 'deleted_at'], 'penyidikan_no_spdp_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyidikan');
    }
}; 