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
      Schema::create('tembusan_surats', function (Blueprint $table) {
    $table->id();
    $table->foreignId('pengajuan_id')->constrained()->cascadeOnDelete();
    $table->string('nama_tembusan');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tembusan_surats');
    }
};
