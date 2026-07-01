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
        Schema::create('sesi_presensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_id')->constrained('jadwal')->cascadeOnUpdate()->cascadeOnDelete();
            $table->tinyInteger('pertemuan_ke');
            $table->date('tanggal');
            $table->string('token', 100)->unique();
            $table->dateTime('opened_at');
            $table->dateTime('expired_at');
            $table->dateTime('closed_at')->nullable();
            $table->enum('status', ['OPEN', 'CLOSED', 'CANCELLED']);
            $table->timestamps();

            $table->index('token');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sesi_presensi');
    }
};
