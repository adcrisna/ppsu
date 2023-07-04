<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KoordinatorController;
use App\Http\Controllers\LurahController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\TimController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::any('/', [LoginController::class, 'index'])->name('index');
Route::any('/proses_login', [LoginController::class, 'prosesLogin'])->name('login');
Route::any('/logout', [LoginController::class, 'logout'])->name('logout');
Route::any('/laporan', [LurahController::class, 'laporan'])->name('laporan');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->middleware(['admin'])->group(function () {
        Route::any('/home', [AdminController::class, 'index'])->name('admin.home');
        Route::any('/profile', [AdminController::class, 'profile'])->name('admin.profile');
        Route::any('/profileUpdate', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');
        Route::any('/lurah', [AdminController::class, 'lurah'])->name('admin.lurah');
        Route::any('/lurahUpdate', [AdminController::class, 'updateLurah'])->name('admin.updateLurah');
        Route::any('/koordinator', [AdminController::class, 'koordinator'])->name('admin.koordinator');
        Route::any('/koordinatorDelete/{id}', [AdminController::class, 'deleteKoordinator'])->name('admin.deleteKoordinator');
        Route::any('/koordinatorAdd', [AdminController::class, 'addKoordinator'])->name('admin.addKoordinator');
        Route::any('/koordinatorUpdate', [AdminController::class, 'updateKoordinator'])->name('admin.updateKoordinator');

        Route::any('/area', [AreaController::class, 'index'])->name('admin.area');
        Route::any('/areaAdd', [AreaController::class, 'addArea'])->name('admin.addArea');
        Route::any('/areaUpdate', [AreaController::class, 'updateArea'])->name('admin.updateArea');
        Route::any('/areaDelete/{id}', [AreaController::class, 'deleteArea'])->name('admin.deleteArea');

        Route::any('/tim', [TimController::class, 'index'])->name('admin.tim');
        Route::any('/timAdd', [TimController::class, 'addTim'])->name('admin.addTim');
        Route::any('/timUpdate', [TimController::class, 'updateTim'])->name('admin.updateTim');
        Route::any('/timDelete/{id}', [TimController::class, 'deleteTim'])->name('admin.deleteTim');

        Route::any('/jadwal', [JadwalController::class, 'index'])->name('admin.jadwal');
        Route::any('/jadwalAdd', [JadwalController::class, 'addJadwal'])->name('admin.addJadwal');
        Route::any('/jadwalUpdate', [JadwalController::class, 'updateJadwal'])->name('admin.updateJadwal');
        Route::any('/jadwalDelete/{id}', [JadwalController::class, 'deleteJadwal'])->name('admin.deleteJadwal');
        
        Route::any('/kegiatan', [KegiatanController::class, 'index'])->name('admin.kegiatan');
        Route::any('/kegiatanUpdate', [KegiatanController::class, 'updateKegiatan'])->name('admin.updateKegiatan');
        Route::any('/kegiatanDetail/{id}', [KegiatanController::class, 'detail'])->name('admin.detail');
        Route::any('/kegiatanDelete/{id}', [KegiatanController::class, 'deleteKegiatan'])->name('admin.deleteKegiatan');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('koordinator')->middleware(['koordinator'])->group(function () {
        Route::any('/home', [KoordinatorController::class, 'index'])->name('koordinator.home');
        Route::any('/profile', [KoordinatorController::class, 'profile'])->name('koordinator.profile');
        Route::any('/profileUpdate', [KoordinatorController::class, 'updateProfile'])->name('koordinator.updateProfile');
        
        Route::any('/kegiatan', [KoordinatorController::class, 'kegiatan'])->name('koordinator.kegiatan');
        Route::any('/kegiatanAdd', [KoordinatorController::class, 'addKegiatan'])->name('koordinator.addKegiatan');
        Route::any('/kegiatanDetail/{id}', [KoordinatorController::class, 'detail'])->name('koordinator.detail');

        Route::any('/jadwal', [KoordinatorController::class, 'jadwal'])->name('koordinator.jadwal');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('lurah')->middleware(['lurah'])->group(function () {
        Route::any('/home', [LurahController::class, 'index'])->name('lurah.home');
        Route::any('/profile', [LurahController::class, 'profile'])->name('lurah.profile');
        Route::any('/profileUpdate', [LurahController::class, 'updateProfile'])->name('lurah.updateProfile');
        
        Route::any('/kegiatan', [LurahController::class, 'kegiatan'])->name('lurah.kegiatan');
        Route::any('/kegiatanDetail/{id}', [LurahController::class, 'detail'])->name('lurah.detail');
    });
});