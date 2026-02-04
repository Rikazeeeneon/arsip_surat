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
    Schema::create('pengajuans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();

        $table->string('nomor_surat');
        $table->date('tanggal_surat');

        $table->string('asal_surat');

        $table->enum('status', [
            'diterima_sistem',
            'diproses',
            'disetujui',
            'ditolak'
        ])->default('diterima_sistem');

        $table->boolean('verifikasi_data')->default(false);
        $table->boolean('verifikasi_berkas')->default(false);

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
