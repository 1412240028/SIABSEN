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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dosen_id')->constrained('dosen')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('kelas_id')->constrained('kelas')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('mata_kuliah_id')->constrained('mata_kuliah')->cascadeOnUpdate()->restrictOnDelete();
            $table->enum('semester', ['Ganjil', 'Genap']);
            $table->string('tahun_ajaran', 20);
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('ruangan', 50)->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['hari', 'semester']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
