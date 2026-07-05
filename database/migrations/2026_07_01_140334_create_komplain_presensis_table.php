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
        Schema::create('komplain_presensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->cascadeOnDelete();
            $table->foreignId('sesi_presensi_id')->constrained('sesi_presensi')->cascadeOnDelete();
            $table->text('alasan');
            $table->string('bukti')->nullable();
            $table->enum('status', ['PENDING', 'RESOLVED', 'REJECTED'])->default('PENDING');
            $table->text('tanggapan')->nullable(); // Tanggapan dosen/admin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komplain_presensis');
    }
};
