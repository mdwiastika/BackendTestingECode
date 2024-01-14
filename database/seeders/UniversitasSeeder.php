<?php

namespace Database\Seeders;

use App\Models\Universitas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UniversitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $universitas = [
            [
                'nama_universitas' => 'Politeknik Elektronika Negeri Surabaya',
                'alamat_universitas' => 'Surabaya',
            ],
            [
                'nama_universitas' => 'Institut Negeri Bandung',
                'alamat_universitas' => 'Bandung',
            ],
            [
                'nama_universitas' => 'Institut Negeri Bandung',
                'alamat_universitas' => 'Bandung',
            ],
            [
                'nama_universitas' => 'Universitas Indonesia',
                'alamat_universitas' => 'Depok',
            ],
        ];
        Universitas::insert($universitas);
    }
}
