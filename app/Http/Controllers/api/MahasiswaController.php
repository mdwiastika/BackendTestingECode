<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ResponseJsonTemplate;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        try {
            $mahasiswas = User::query()->where('level_user', 'Mahasiswa')->latest()->paginate(10);
            return ResponseJsonTemplate::responseJson(200, 'success', "Berhasil mendapatkan data!", $mahasiswas);
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }
    public function store(Request $request)
    {
        try {
            $validated_data = $request->validate([
                'nama' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required',
                'nrp' => 'required|unique:users',
                'universitas_id' => 'required',
                'jurusan_id' => 'required',
                'no_hp' => 'required',
                'alamat' => 'required'
            ]);
            $validated_data['level_user'] = 'Mahasiswa';
            $validated_data['password'] = Hash::make($validated_data['password']);
            $user = User::create($validated_data);
            if ($user) {
                return ResponseJsonTemplate::responseJson(200, 'success', 'Sukses Tambah Mahasiswa', $user);
            } else {
                return ResponseJsonTemplate::responseJson(404, 'error', 'Gagal Tambah Mahasiswa', null);
            }
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }
    public function show(string $id)
    {
        try {
            $user = User::where('level_user', 'Mahasiswa')->where('id', $id)->first();
            if ($user) {
                return ResponseJsonTemplate::responseJson(200, 'success', 'Sukses Mendapatkan Mahasiswa', $user);
            } else {
                return ResponseJsonTemplate::responseJson(404, 'error', 'Gagal Mendapatkan Mahasiswa', null);
            }
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $user = User::where('level_user', 'Mahasiswa')->where('id', $id)->first();
            if ($user) {
                $validated_data = $request->validate([
                    'nama' => 'required',
                    'email' => 'required|unique:users,email,' . $user->id,
                    'password' => 'required',
                    'nrp' => 'required|unique:users,nrp,' . $user->id,
                    'universitas_id' => 'required',
                    'jurusan_id' => 'required',
                    'no_hp' => 'required',
                    'alamat' => 'required'
                ]);
                $validated_data['level_user'] = 'Mahasiswa';
                $validated_data['password'] = Hash::make($validated_data['password']);
                $user->update($validated_data);
                return ResponseJsonTemplate::responseJson(200, 'success', 'Sukses Ubah Mahasiswa', $user);
            } else {
                return ResponseJsonTemplate::responseJson(404, 'error', 'Gagal Ubah Mahasiswa', null);
            }
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }
    public function destroy(string $id)
    {
        try {
            $user = User::where('level_user', 'Mahasiswa')->where('id', $id)->first();
            if ($user) {
                $user->delete();
                return ResponseJsonTemplate::responseJson(200, 'success', 'Sukses Menghapus Mahasiswa', $user);
            } else {
                return ResponseJsonTemplate::responseJson(404, 'error', 'Gagal Menghapus Mahasiswa', null);
            }
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }
}
