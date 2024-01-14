<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jurusans = [
            [
                'nama_jurusan' => 'TI',
                'universitas_id' => 1,
            ],
            [
                'nama_jurusan' => 'APHP',
                'universitas_id' => 1,
            ],
            [
                'nama_jurusan' => 'Game',
                'universitas_id' => 2,
            ],
            [
                'nama_jurusan' => 'Matematika',
                'universitas_id' => 2,
            ],
        ];
        Jurusan::insert($jurusans);
    }
}
