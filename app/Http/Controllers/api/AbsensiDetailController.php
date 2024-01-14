<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\AbsensiDetail;
use App\Http\Controllers\Controller;
use App\Traits\ResponseJsonTemplate;
use Illuminate\Validation\Rule;

class AbsensiDetailController extends Controller
{
    public function index(Request $request)
    {
        try {
            $absensi_details = AbsensiDetail::query()->latest()->paginate(10);
            return ResponseJsonTemplate::responseJson(200, 'success', "Berhasil mendapatkan data!", $absensi_details);
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }
    public function store(Request $request)
    {
        try {
            $validated_data = $request->validate([
                'absensi_id' => 'required',
                'mahasiswa_id' => 'required',
                'status_kehadiran' => ['required', Rule::in(['Sakit', 'Izin', 'Alpha', 'Masuk'])],
                'alasan' => 'required',
            ]);
            $absensi_detail_duplikat = AbsensiDetail::query()->where('absensi_id', $validated_data['absensi_id'])->where('mahasiswa_id', $validated_data['mahasiswa_id'])->first();
            if ($absensi_detail_duplikat) {
                return ResponseJsonTemplate::responseJson(500, 'error', 'Absensi Untuk Kelas ini Sudah Dibuat Sebelumnya', null);
            }
            $absensi = AbsensiDetail::create($validated_data);
            if ($absensi) {
                return ResponseJsonTemplate::responseJson(200, 'success', 'Sukses Tambah Absensi Mahasiswa', $absensi);
            } else {
                return ResponseJsonTemplate::responseJson(404, 'error', 'Gagal Tambah Absensi Mahasiswa', null);
            }
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }
    public function show(string $id)
    {
        try {
            $absensi = AbsensiDetail::where('id', $id)->first();
            if ($absensi) {
                return ResponseJsonTemplate::responseJson(200, 'success', 'Sukses Mendapatkan Absensi Mahasiswa', $absensi);
            } else {
                return ResponseJsonTemplate::responseJson(404, 'error', 'Gagal Mendapatkan Absensi Mahasiswa', null);
            }
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $absensi = AbsensiDetail::where('id', $id)->first();
            if ($absensi) {
                $validated_data = $request->validate([
                    'absensi_id' => 'required',
                    'mahasiswa_id' => 'required',
                    'status_kehadiran' => ['required', Rule::in(['Sakit', 'Izin', 'Alpha', 'Masuk'])],
                    'alasan' => 'required',
                ]);
                $absensi_detail_duplikat = AbsensiDetail::query()->where('absensi_id', $validated_data['absensi_id'])->where('mahasiswa_id', $validated_data['mahasiswa_id'])->first();
                if ($absensi_detail_duplikat && $absensi_detail_duplikat->id != $id) {
                    return ResponseJsonTemplate::responseJson(500, 'error', 'Absensi Untuk Kelas ini Sudah Dibuat Sebelumnya', null);
                }
                $absensi->update($validated_data);
                return ResponseJsonTemplate::responseJson(200, 'success', 'Sukses Ubah Absensi Mahasiswa', $absensi);
            } else {
                return ResponseJsonTemplate::responseJson(404, 'error', 'Gagal Ubah Absensi Mahasiswa', null);
            }
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }
    public function destroy(string $id)
    {
        try {
            $absensi = AbsensiDetail::where('id', $id)->first();
            if ($absensi) {
                $absensi->delete();
                return ResponseJsonTemplate::responseJson(200, 'success', 'Sukses Menghapus Absensi Mahasiswa', $absensi);
            } else {
                return ResponseJsonTemplate::responseJson(404, 'error', 'Gagal Menghapus Absensi Mahasiswa', null);
            }
        } catch (\Throwable $th) {
            return ResponseJsonTemplate::responseJson(500, 'error', $th->getMessage(), null);
        }
    }
}
