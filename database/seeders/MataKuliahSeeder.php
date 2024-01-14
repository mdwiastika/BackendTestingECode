<?php

namespace Database\Seeders;

use App\Models\MataKuliah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mata_kuliahs = [
            [
                'dosen_id' => 1,
                'nama_mata_kuliah' => 'Logika & Algoritma',
                'hari_mata_kuliah' => 'Rabu',
                'waktu_awal_mata_kuliah' => '08:20',
                'waktu_akhir_mata_kuliah' => '10:20',
            ],
            [
                'dosen_id' => 2,
                'nama_mata_kuliah' => 'PKN',
                'hari_mata_kuliah' => 'Selasa',
                'waktu_awal_mata_kuliah' => '09:20',
                'waktu_akhir_mata_kuliah' => '11:20',
            ],
        ];
        MataKuliah::insert($mata_kuliahs);
    }
}
