<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'nama' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('superadmin'),
                'level_user' => 'Super Admin',
                'universitas_id' => 1,
                'jurusan_id' => 2,
                'nrp' => null,
                'no_hp' => null,
                'alamat' => '-'
            ],
            [
                'nama' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'level_user' => 'Admin',
                'universitas_id' => 1,
                'jurusan_id' => 2,
                'nrp' => null,
                'no_hp' => null,
                'alamat' => '-'
            ],
            [
                'nama' => 'Budi Susilo',
                'email' => 'budisusilo@gmail.com',
                'password' => Hash::make('budisusilo'),
                'level_user' => 'Dosen',
                'universitas_id' => 1,
                'jurusan_id' => 2,
                'nrp' => '912012901212',
                'no_hp' => '0182918212',
                'alamat' => '-'
            ],
            [
                "nama" => "Yuni Saputri",
                "email" => "yunisaputri@gmail.com",
                "password" => Hash::make("yunisaputri"),
                "level_user" => "Dosen",
                "universitas_id" => 2,
                'jurusan_id' => 4,
                "nrp" => "912012901213",
                "no_hp" => "0182918213",
                "alamat" => "-"
            ],
            [
                'nama' => 'Marcel Dwi',
                'email' => 'marceldwi@gmail.com',
                'password' => Hash::make('marceldwi'),
                'level_user' => 'Mahasiswa',
                'universitas_id' => 1,
                'jurusan_id' => 2,
                'nrp' => '912012901214',
                'no_hp' => '0182918215',
                'alamat' => '-'
            ],
            [
                'nama' => 'Indah Sari',
                'email' => 'indahsari@gmail.com',
                'password' => Hash::make('indahsari'),
                'level_user' => 'Mahasiswa',
                'universitas_id' => 2,
                'jurusan_id' => 3,
                'nrp' => '912012901216',
                'no_hp' => '0182918217',
                'alamat' => '-'
            ],
        ];
        User::insert($users);
    }
}
