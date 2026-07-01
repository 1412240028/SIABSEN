<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('presensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sesi_presensi_id')->constrained('sesi_presensi')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->cascadeOnUpdate()->restrictOnDelete();
            $table->enum('status', ['HADIR', 'TERLAMBAT', 'IZIN', 'SAKIT', 'ALPHA']);
            $table->enum('metode', ['QR', 'MANUAL']);
            $table->dateTime('waktu_presensi')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->index(['mahasiswa_id', 'sesi_presensi_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('presensi');
    }
};
