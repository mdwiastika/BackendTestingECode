<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Universitas;
use App\Models\User;
use Database\Factories\UniversitasFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UniversitasSeeder::class,
            JurusanSeeder::class,
            UserSeeder::class,
            MataKuliahSeeder::class,
            NilaiMataKuliahSeeder::class,
            AbsensiSeeder::class,
            AbsensiDetailSeeder::class,
        ]);
    }
}
