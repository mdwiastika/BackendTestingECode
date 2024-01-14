<?php

namespace App\Http\Controllers\api;

use App\Models\Absensi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ResponseJsonTemplate;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        try {
            $absensis = Absensi::query()->latest()->paginate(10);
            return ResponseJsonTemplate::responseJson(200, 'success', "Berhasil mendapatkan data!", $absensis);
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }
    public function indexSearch(Request $request, $mata_kuliah_id, $tanggal_absensi)
    {
        try {
            $absensis = Absensi::query()->where('tanggal_absensi', $tanggal_absensi)->where('mata_kuliah_id', $mata_kuliah_id)->with(['absensi_details'])->latest()->paginate(10);
            return ResponseJsonTemplate::responseJson(200, 'success', "Berhasil mendapatkan data!", $absensis);
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }
    public function store(Request $request)
    {
        try {
            $validated_data = $request->validate([
                'mata_kuliah_id' => 'required',
                'tanggal_absensi' => 'required|date',
            ]);
            $absensi_duplikat = Absensi::query()->where('mata_kuliah_id', $validated_data['mata_kuliah_id'])->where('tanggal_absensi', $validated_data['tanggal_absensi'])->first();
            if ($absensi_duplikat) {
                return ResponseJsonTemplate::responseJson(500, 'error', 'Absensi Untuk Kelas ini Sudah Dibuat Sebelumnya', null);
            }
            $absensi = Absensi::create($validated_data);
            if ($absensi) {
                return ResponseJsonTemplate::responseJson(200, 'success', 'Sukses Tambah Absensi', $absensi);
            } else {
                return ResponseJsonTemplate::responseJson(404, 'error', 'Gagal Tambah Absensi', null);
            }
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }
    public function show(string $id)
    {
        try {
            $absensi = Absensi::where('id', $id)->first();
            if ($absensi) {
                return ResponseJsonTemplate::responseJson(200, 'success', 'Sukses Mendapatkan Absensi', $absensi);
            } else {
                return ResponseJsonTemplate::responseJson(404, 'error', 'Gagal Mendapatkan Absensi', null);
            }
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $absensi = Absensi::where('id', $id)->first();
            if ($absensi) {
                $validated_data = $request->validate([
                    'mata_kuliah_id' => 'required',
                    'tanggal_absensi' => 'required',
                ]);
                $absensi_duplikat = Absensi::query()->where('mata_kuliah_id', $validated_data['mata_kuliah_id'])->where('tanggal_absensi', $validated_data['tanggal_absensi'])->first();
                if ($absensi_duplikat && $absensi_duplikat->id != $id) {
                    return ResponseJsonTemplate::responseJson(500, 'error', 'Absensi Untuk Kelas ini Sudah Dibuat Sebelumnya', null);
                }
                $absensi->update($validated_data);
                return ResponseJsonTemplate::responseJson(200, 'success', 'Sukses Ubah Absensi', $absensi);
            } else {
                return ResponseJsonTemplate::responseJson(404, 'error', 'Gagal Ubah Absensi', null);
            }
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }
    public function destroy(string $id)
    {
        try {
            $absensi = Absensi::where('id', $id)->first();
            if ($absensi) {
                $absensi->delete();
                return ResponseJsonTemplate::responseJson(200, 'success', 'Sukses Menghapus Absensi', $absensi);
            } else {
                return ResponseJsonTemplate::responseJson(404, 'error', 'Gagal Menghapus Absensi', null);
            }
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }
}
