<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('progress_donasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donasi_id')->constrained('donasi')->onDelete('cascade');
            $table->string('judul');
            $table->text('deskripsi');
            $table->integer('persentase_progress');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progress_donasi');
    }
}; 