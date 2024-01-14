<?php

namespace App\Http\Controllers\api;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ResponseJsonTemplate;

class JurusanController extends Controller
{
    public function index(Request $request)
    {
        try {
            $jurusans = Jurusan::query()->latest()->paginate(10);
            return ResponseJsonTemplate::responseJson(200, 'success', "Berhasil mendapatkan data!", $jurusans);
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }
    public function store(Request $request)
    {
        try {
            $validated_data = $request->validate([
                'nama_jurusan' => 'required',
                'universitas_id' => 'required',
            ]);
            $jurusan = Jurusan::create($validated_data);
            if ($jurusan) {
                return ResponseJsonTemplate::responseJson(200, 'success', 'Sukses Tambah Jurusan', $jurusan);
            } else {
                return ResponseJsonTemplate::responseJson(404, 'error', 'Gagal Tambah Jurusan', null);
            }
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }
    public function show(string $id)
    {
        try {
            $jurusan = Jurusan::where('id', $id)->first();
            if ($jurusan) {
                return ResponseJsonTemplate::responseJson(200, 'success', 'Sukses Mendapatkan Jurusan', $jurusan);
            } else {
                return ResponseJsonTemplate::responseJson(404, 'error', 'Gagal Mendapatkan Jurusan', null);
            }
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $jurusan = Jurusan::where('id', $id)->first();
            if ($jurusan) {
                $validated_data = $request->validate([
                    'nama_jurusan' => 'required',
                    'universitas_id' => 'required',
                ]);
                $jurusan->update($validated_data);
                return ResponseJsonTemplate::responseJson(200, 'success', 'Sukses Ubah Jurusan', $jurusan);
            } else {
                return ResponseJsonTemplate::responseJson(404, 'error', 'Gagal Ubah Jurusan', null);
            }
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }
    public function destroy(string $id)
    {
        try {
            $jurusan = Jurusan::where('id', $id)->first();
            if ($jurusan) {
                $jurusan->delete();
                return ResponseJsonTemplate::responseJson(200, 'success', 'Sukses Menghapus Jurusan', $jurusan);
            } else {
                return ResponseJsonTemplate::responseJson(404, 'error', 'Gagal Menghapus Jurusan', null);
            }
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }
}
