<?php

use App\Http\Controllers\api\AbsensiController;
use App\Http\Controllers\api\AbsensiDetailController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\DosenController;
use App\Http\Controllers\api\JurusanController;
use App\Http\Controllers\api\MahasiswaController;
use App\Http\Controllers\api\MataKuliahController;
use App\Http\Controllers\api\NilaiMataKuliahController;
use App\Http\Controllers\api\UniversitasController;
use App\Http\Controllers\api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user-login', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::middleware('is_admin')->group(function () {
        Route::resource('/user', UserController::class);
        Route::post('/user/create', [UserController::class, 'store']);

        Route::resource('/universitas', UniversitasController::class);
        Route::post('/universitas/create', [UniversitasController::class, 'store']);

        Route::resource('/jurusan', JurusanController::class);
        Route::post('/jurusan/create', [JurusanController::class, 'store']);

        Route::resource('/dosen', DosenController::class);
        Route::post('/dosen/create', [DosenController::class, 'store']);
    });
    Route::middleware('is_dosen')->group(function () {
        Route::resource('/mahasiswa', MahasiswaController::class);
        Route::post('/mahasiswa/create', [MahasiswaController::class, 'store']);

        Route::resource('/mata-kuliah', MataKuliahController::class);
        Route::post('/mata-kuliah/create', [MataKuliahController::class, 'store']);

        Route::resource('/nilai-mata-kuliah', NilaiMataKuliahController::class);
        Route::post('/nilai-mata-kuliah/create', [NilaiMataKuliahController::class, 'store']);

        Route::resource('/absensi', AbsensiController::class);
        Route::post('/absensi/create', [AbsensiController::class, 'store']);

        Route::resource('/absensi-detail', AbsensiDetailController::class);
    });
    Route::get('/absensi/{mata_kuliah_id}/{tanggal_absensi}', [AbsensiController::class, 'indexSearch']);
    Route::post('/absensi-detail/create', [AbsensiDetailController::class, 'store']);

    Route::get('/universitas', [UniversitasController::class, 'index']);
    Route::get('/universitas/{id}', [UniversitasController::class, 'show']);

    Route::get('/jurusan', [JurusanController::class, 'index']);
    Route::get('/jurusan/{id}', [JurusanController::class, 'show']);

    Route::get('/dosen', [DosenController::class, 'index']);
    Route::get('/dosen/{id}', [DosenController::class, 'show']);

    Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
    Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show']);

    Route::get('/mata-kuliah', [MataKuliahController::class, 'index']);
    Route::get('/mata-kuliah/{id}', [MataKuliahController::class, 'show']);

    Route::get('/nilai-mata-kuliah', [NilaiMataKuliahController::class, 'index']);
    Route::get('/nilai-mata-kuliah/{id}', [NilaiMataKuliahController::class, 'show']);
});
Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});
