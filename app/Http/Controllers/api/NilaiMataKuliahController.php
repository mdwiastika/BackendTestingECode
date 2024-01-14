<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\NilaiMataKuliah;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Traits\ResponseJsonTemplate;

class NilaiMataKuliahController extends Controller
{
    public function index(Request $request)
    {
        try {
            $nilai_mata_kuliahs = NilaiMataKuliah::query()->latest()->paginate(10);
            return ResponseJsonTemplate::responseJson(200, 'success', "Berhasil mendapatkan data!", $nilai_mata_kuliahs);
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }
    public function store(Request $request)
    {
        try {
            $validated_data = $request->validate([
                'mata_kuliah_id' => 'required',
                'mahasiswa_id' => 'required',
                'jenis_nilai' => ['required', Rule::in(['Tugas', 'UTS', 'UAS'])],
                'nilai_mata_kuliah' => 'required|numeric',
                'grade_mata_kuliah' => 'required',
            ]);
            $nilai_mata_kuliah_duplikat = NilaiMataKuliah::query()->where('mata_kuliah_id', $validated_data['mata_kuliah_id'])->where('mahasiswa_id', $validated_data['mahasiswa_id'])->first();
            if ($nilai_mata_kuliah_duplikat) {
                return ResponseJsonTemplate::responseJson(500, 'error', 'Nilai Matkul Untuk Kelas ini Sudah Dibuat Sebelumnya', null);
            }
            $nilai_mata_kuliah = NilaiMataKuliah::create($validated_data);
            if ($nilai_mata_kuliah) {
                return ResponseJsonTemplate::responseJson(200, 'success', 'Sukses Tambah Nilai Matkul Mahasiswa', $nilai_mata_kuliah);
            } else {
                return ResponseJsonTemplate::responseJson(404, 'error', 'Gagal Tambah Nilai Matkul Mahasiswa', null);
            }
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }
    public function show(string $id)
    {
        try {
            $nilai_mata_kuliah = NilaiMataKuliah::where('id', $id)->first();
            if ($nilai_mata_kuliah) {
                return ResponseJsonTemplate::responseJson(200, 'success', 'Sukses Mendapatkan Nilai Matkul Mahasiswa', $nilai_mata_kuliah);
            } else {
                return ResponseJsonTemplate::responseJson(404, 'error', 'Gagal Mendapatkan Nilai Matkul Mahasiswa', null);
            }
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $nilai_mata_kuliah = NilaiMataKuliah::where('id', $id)->first();
            if ($nilai_mata_kuliah) {
                $validated_data = $request->validate([
                    'mata_kuliah_id' => 'required',
                    'mahasiswa_id' => 'required',
                    'jenis_nilai' => ['required', Rule::in(['Tugas', 'UTS', 'UAS'])],
                    'nilai_mata_kuliah' => 'required|numeric',
                    'grade_mata_kuliah' => 'required',
                ]);
                $nilai_mata_kuliah_duplikat = NilaiMataKuliah::query()->where('mata_kuliah_id', $validated_data['mata_kuliah_id'])->where('mahasiswa_id', $validated_data['mahasiswa_id'])->first();
                if ($nilai_mata_kuliah_duplikat && $nilai_mata_kuliah_duplikat->id != $id) {
                    return ResponseJsonTemplate::responseJson(500, 'error', 'Nilai Matkul Untuk Kelas ini Sudah Dibuat Sebelumnya', null);
                }
                $nilai_mata_kuliah->update($validated_data);
                return ResponseJsonTemplate::responseJson(200, 'success', 'Sukses Ubah Nilai Matkul Mahasiswa', $nilai_mata_kuliah);
            } else {
                return ResponseJsonTemplate::responseJson(404, 'error', 'Gagal Ubah Nilai Matkul Mahasiswa', null);
            }
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }
    public function destroy(string $id)
    {
        try {
            $nilai_mata_kuliah = NilaiMataKuliah::where('id', $id)->first();
            if ($nilai_mata_kuliah) {
                $nilai_mata_kuliah->delete();
                return ResponseJsonTemplate::responseJson(200, 'success', 'Sukses Menghapus Nilai Matkul Mahasiswa', $nilai_mata_kuliah);
            } else {
                return ResponseJsonTemplate::responseJson(404, 'error', 'Gagal Menghapus Nilai Matkul Mahasiswa', null);
            }
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }
}
