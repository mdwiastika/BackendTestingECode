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
        Schema::create('nilai_mata_kuliahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mata_kuliah_id')->constrained('mata_kuliahs', 'id')->cascadeOnDelete();
            $table->foreignId('mahasiswa_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->enum('jenis_nilai', ['Tugas', 'UTS', 'UAS']);
            $table->integer('nilai_mata_kuliah');
            $table->char('grade_mata_kuliah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_mata_kuliahs');
    }
};
