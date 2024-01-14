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
        Schema::create('absensi_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('absensi_id')->constrained('absensis', 'id')->cascadeOnDelete();
            $table->foreignId('mahasiswa_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->enum('status_kehadiran', ['Sakit', 'Izin', 'Alpha', 'Masuk']);
            $table->text('alasan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_details');
    }
};
