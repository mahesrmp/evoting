<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CalonController;
use App\Http\Controllers\Calon2Controller;
use App\Http\Controllers\PemilihController;
use App\Http\Controllers\DataPemilihController;
use App\Http\Middleware\RedirectIfAuthenticated;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'prevent-back-history'], function () {

    Route::middleware([RedirectIfAuthenticated::class . ':admin,pemilih'])->group(function () {
    });
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'prosesRegister']);

    Route::post('/login', [AuthController::class, 'proseslogin']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/dataCalonKomandanResimen', [CalonController::class, 'index']);
        Route::post('/kandidatKomandanResimen-add', [CalonController::class, 'store']);
        Route::get('/dataKandidatKomandanResimen/edit/{id}', [CalonController::class, 'edit']);
        Route::post('/dataKandidatKomandanResimen/edit/{id}', [CalonController::class, 'update']);
        Route::post('/dataKandidatKomandanResimen/{id}/delete', [CalonController::class, 'destroy']);

        Route::get('/dataCalonKetuaDemustar', [Calon2Controller::class, 'index']);
        Route::post('/kandidatKetuaDemustar-add', [Calon2Controller::class, 'store']);
        Route::get('/dataKandidatKetuaDemustar/edit/{id}', [Calon2Controller::class, 'edit']);
        Route::post('/dataKandidatKetuaDemustar/edit/{id}', [Calon2Controller::class, 'update']);
        Route::post('/dataKandidatKetuaDemustar/{id}/delete', [Calon2Controller::class, 'destroy']);

        Route::get('/suaraCalonKomandanResimen', [DataPemilihController::class, 'kotakSuaraKomandanResimen']);
        Route::get('/suaraCalonKetuaDemustar', [DataPemilihController::class, 'kotakSuaraKetuaDemustar']);

        Route::get('/suaraSementaraCalonKomandanResimen', [DataPemilihController::class, 'suaraSementaraCalonKomandanResimen']);
        Route::get('/suaraSementaraCalonKetuaDemustar', [DataPemilihController::class, 'suaraSementaraCalonKetuaDemustar']);

        Route::get('/laporanKomandan', [AdminController::class, 'laporanKomandan']);
        Route::get('/laporanKetua', [AdminController::class, 'laporanKetua']);
    });

    Route::middleware(['auth', 'role:pemilih'])->group(function () {
        Route::get('/dashboard/pemilih', [PemilihController::class, 'indexKomandan']);
        Route::get('/detailDataKandidatKomandan/{id}', [PemilihController::class, 'detailKomandan']);
        Route::get('/pilihKandidatKomandan/{id}', [PemilihController::class, 'pilihKomandan']);
        Route::post('/pilihKandidatKomandan/{id}', [PemilihController::class, 'pilihprosKomandan'])->name('pilihpros');
        Route::get('/dashboard/pemilihKomandan', [PemilihController::class, 'indexKomandan'])->name('konfirmasi-pemilihan');
        Route::get('/pilih-kandidatKomandan/{id}', [PemilihController::class, 'pilihKomandan'])->middleware('check.voting.status');


        Route::get('/dashboard/pemilihKetua', [PemilihController::class, 'indexKetua']);
        Route::get('/detailDataKandidatKetua/{id}', [PemilihController::class, 'detailKetua']);
        Route::get('/pilihKandidatKetua/{id}', [PemilihController::class, 'pilihKetua']);
        Route::post('/pilihKandidatKetua/{id}', [PemilihController::class, 'pilihprosKetua'])->name('pilihpros-ketua');
        Route::get('/dashboard/pemilihKetua', [PemilihController::class, 'indexKetua'])->name('konfirmasi-pemilihan-ketua');
        Route::get('/pilih-kandidatKetua/{id}', [PemilihController::class, 'pilihKetua'])->middleware('check.voting.status.ketua');
    });
});
