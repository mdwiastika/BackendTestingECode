<?php

namespace App\Http\Controllers\api;

use App\Models\Universitas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ResponseJsonTemplate;
use Illuminate\Support\Facades\Hash;

class UniversitasController extends Controller
{
    public function index(Request $request)
    {
        try {
            $universitass = Universitas::query()->latest()->paginate(10);
            return ResponseJsonTemplate::responseJson(200, 'success', "Berhasil mendapatkan data!", $universitass);
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }
    public function store(Request $request)
    {
        try {
            $validated_data = $request->validate([
                'nama_universitas' => 'required',
                'alamat_universitas' => 'required',
            ]);
            $universitas = Universitas::create($validated_data);
            if ($universitas) {
                return ResponseJsonTemplate::responseJson(200, 'success', 'Sukses Tambah Universitas', $universitas);
            } else {
                return ResponseJsonTemplate::responseJson(404, 'error', 'Gagal Tambah Universitas', null);
            }
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }
    public function show(string $id)
    {
        try {
            $universitas = Universitas::where('id', $id)->first();
            if ($universitas) {
                return ResponseJsonTemplate::responseJson(200, 'success', 'Sukses Mendapatkan Universitas', $universitas);
            } else {
                return ResponseJsonTemplate::responseJson(404, 'error', 'Gagal Mendapatkan Universitas', null);
            }
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $universitas = Universitas::where('id', $id)->first();
            if ($universitas) {
                $validated_data = $request->validate([
                    'nama_universitas' => 'required',
                    'alamat_universitas' => 'required',
                ]);
                $universitas->update($validated_data);
                return ResponseJsonTemplate::responseJson(200, 'success', 'Sukses Ubah Universitas', $universitas);
            } else {
                return ResponseJsonTemplate::responseJson(404, 'error', 'Gagal Ubah Universitas', null);
            }
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }
    public function destroy(string $id)
    {
        try {
            $universitas = Universitas::where('id', $id)->first();
            if ($universitas) {
                $universitas->delete();
                return ResponseJsonTemplate::responseJson(200, 'success', 'Sukses Menghapus Universitas', $universitas);
            } else {
                return ResponseJsonTemplate::responseJson(404, 'error', 'Gagal Menghapus Universitas', null);
            }
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }
}
