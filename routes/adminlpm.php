<?php

use App\Http\Controllers\AdminLPM\AuditiController;
use App\Http\Controllers\AdminLPM\IdentitasController;
use App\Http\Controllers\AdminLPM\JadwalAuditController;
use App\Http\Controllers\AdminLPM\MonevController;
use App\Http\Controllers\AdminLPM\PeriodeController;
use App\Http\Controllers\DokumenMutuController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/adminlpm', function () {
        return Inertia::render('Home', []);
    })->name('adminlpm');
    Route::get('/adminlpm/identitas', [IdentitasController::class, 'index'])->name('identitas.index');
    Route::get('/adminlpm/identitas/edit', [IdentitasController::class, 'edit'])->name('identitas.edit');
    Route::post('/adminlpm/identitas', [IdentitasController::class, 'update'])->name('identitas.update');

    Route::resource('/adminlpm/auditis', AuditiController::class)->except(['show']);
    Route::resource('/adminlpm/periodes', PeriodeController::class)->except(['show']);
    Route::resource('/adminlpm/jadwal-audits', JadwalAuditController::class)->except(['show', 'update']);
    Route::post('/adminlpm/jadwal-audits/update', [JadwalAuditController::class, 'update'])->name('jadwal-audits.update');
    Route::resource('/adminlpm/monevs', MonevController::class)->except(['show']);
    Route::post('/adminlpm/monevs/update/{id}', [MonevController::class, 'update'])->name('monevs.update');
    Route::post('/adminlpm/dokumen-mutus/update/{id}', [DokumenMutuController::class, 'update'])->name('dokumen-mutus.update');
});

Route::resource('/adminlpm/dokumen-mutus', DokumenMutuController::class)->except(['show', 'update']);
