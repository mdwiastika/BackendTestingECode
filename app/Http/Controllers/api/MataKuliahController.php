<?php

namespace App\Http\Controllers\api;

use App\Models\MataKuliah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ResponseJsonTemplate;
use Illuminate\Validation\Rule;

class MataKuliahController extends Controller
{
    public function index(Request $request)
    {
        try {
            $mata_kuliahs = MataKuliah::query()->latest()->paginate(10);
            return ResponseJsonTemplate::responseJson(200, 'success', "Berhasil mendapatkan data!", $mata_kuliahs);
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }
    public function store(Request $request)
    {
        try {
            $validated_data = $request->validate([
                'dosen_id' => 'required',
                'nama_mata_kuliah' => 'required',
                'hari_mata_kuliah' => ['required', Rule::in(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'])],
                'waktu_awal_mata_kuliah' => 'required|date_format:H:i',
                'waktu_akhir_mata_kuliah' => 'required|date_format:H:i',
            ]);
            $mata_kuliah = MataKuliah::create($validated_data);
            if ($mata_kuliah) {
                return ResponseJsonTemplate::responseJson(200, 'success', 'Sukses Tambah Mata Kuliah', $mata_kuliah);
            } else {
                return ResponseJsonTemplate::responseJson(404, 'error', 'Gagal Tambah Mata Kuliah', null);
            }
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }
    public function show(string $id)
    {
        try {
            $mata_kuliah = MataKuliah::where('id', $id)->first();
            if ($mata_kuliah) {
                return ResponseJsonTemplate::responseJson(200, 'success', 'Sukses Mendapatkan Mata Kuliah', $mata_kuliah);
            } else {
                return ResponseJsonTemplate::responseJson(404, 'error', 'Gagal Mendapatkan Mata Kuliah', null);
            }
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $mata_kuliah = MataKuliah::where('id', $id)->first();
            if ($mata_kuliah) {
                $validated_data = $request->validate([
                    'dosen_id' => 'required',
                    'nama_mata_kuliah' => 'required',
                    'hari_mata_kuliah' => ['required', Rule::in(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'])],
                    'waktu_awal_mata_kuliah' => 'required|date_format:H:i',
                    'waktu_akhir_mata_kuliah' => 'required|date_format:H:i',
                ]);
                if (!in_array($validated_data['hari_mata_kuliah'], ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'])) {
                    return ResponseJsonTemplate::responseJson(500, 'error', 'Masukkan format hari yang sesuai', null);
                }
                $mata_kuliah->update($validated_data);
                return ResponseJsonTemplate::responseJson(200, 'success', 'Sukses Ubah Mata Kuliah', $mata_kuliah);
            } else {
                return ResponseJsonTemplate::responseJson(404, 'error', 'Gagal Ubah Mata Kuliah', null);
            }
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }
    public function destroy(string $id)
    {
        try {
            $mata_kuliah = MataKuliah::where('id', $id)->first();
            if ($mata_kuliah) {
                $mata_kuliah->delete();
                return ResponseJsonTemplate::responseJson(200, 'success', 'Sukses Menghapus Mata Kuliah', $mata_kuliah);
            } else {
                return ResponseJsonTemplate::responseJson(404, 'error', 'Gagal Menghapus Mata Kuliah', null);
            }
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }
}
