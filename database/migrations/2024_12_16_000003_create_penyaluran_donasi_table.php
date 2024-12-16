<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penyaluran_donasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donasi_id')->constrained('donasi');
            $table->foreignId('mitra_id')->constrained('mitra');
            $table->decimal('jumlah', 15, 2);
            $table->string('bukti_penyaluran');
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penyaluran_donasi');
    }
}; 