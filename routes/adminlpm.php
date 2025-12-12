<?php

use App\Http\Controllers\AdminLPM\AkreditasiController;
use App\Http\Controllers\AdminLPM\AuditiController;
use App\Http\Controllers\AdminLPM\AuditorController;
use App\Http\Controllers\AdminLPM\DocumentController;
use App\Http\Controllers\AdminLPM\DokumenAkreditasiController;
use App\Http\Controllers\AdminLPM\DokumenMutuController;
use App\Http\Controllers\AdminLPM\IdentitasController;
use App\Http\Controllers\AdminLPM\JadwalAuditController;
use App\Http\Controllers\AdminLPM\MonevController;
use App\Http\Controllers\AdminLPM\PeriodeController;
use App\Http\Controllers\AdminLPM\UserController;
use App\Http\Controllers\AdminLPM\InstrumenAkreditasiController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/adminlpm', function () {
    return Inertia::render('Home', []);
})->name('adminlpm');

Route::get('/adminlpm/akreditasi', [AkreditasiController::class, 'index'])->name('akreditasi.index');
Route::get('/adminlpm/akreditasi/sertifikat', [AkreditasiController::class, 'sertifikat'])->name('akreditasi.sertifikat');
Route::get('/adminlpm/periodes', [PeriodeController::class, 'index'])->name('periodes.index');
Route::get('/adminlpm/dokumen-mutus/{param}', [DokumenMutuController::class, 'filter'])->name('dokumen-mutus.filter');
Route::get('/adminlpm/dokumen-mutus/create/{param}', [DokumenMutuController::class, 'create'])->name('dokumen-mutus.create');
Route::get('/adminlpm/auditis', [AuditiController::class, 'index'])->name('auditis.index');
Route::get('/adminlpm/jadwal-audits', [JadwalAuditController::class, 'index'])->name('jadwal-audits.index');
Route::get('/adminlpm/hasil-audits', [JadwalAuditController::class, 'hasil'])->name('jadwal-audits.hasil');
Route::get('/adminlpm/auditors', [AuditorController::class, 'index'])->name('auditors.index');
Route::get('/adminlpm/monevs/akademik', [MonevController::class, 'akademik'])->name('monevs.akademik');
Route::get('/adminlpm/monevs/non-akademik', [MonevController::class, 'nonakademik'])->name('monevs.nonakademik');
Route::get('/adminlpm/dokumen-akreditasi', [DokumenAkreditasiController::class, 'index'])->name('dokumen-akreditasi.index');
Route::get('/adminlpm/instrumen-akreditasis', [InstrumenAkreditasiController::class, 'index'])->name('instrumen-akreditasis.index');
Route::get('/adminlpm/documents/{param}', [DocumentController::class, 'index'])->name('documents.index');
Route::get('/adminlpm/documents/create/{param}', [DocumentController::class, 'create'])->name('documents.create');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('/adminlpm/documents', DocumentController::class)->except(['show', 'index', 'create']);
    Route::resource('/adminlpm/instrumen-akreditasis', InstrumenAkreditasiController::class)->except(['index', 'show']);
    Route::post('/adminlpm/instrumen-akreditasis/update/{id}', [InstrumenAkreditasiController::class, 'update'])->name('instrumen-akreditasis.updatepost');
    Route::resource('/adminlpm/monevs', MonevController::class)->except(['show', 'index', 'akademik', 'nonakademik']);
    Route::resource('/adminlpm/users', UserController::class);
    Route::post('/adminlpm/akreditasi', [AkreditasiController::class, 'update'])->name('akreditasi.update');
    Route::post('/adminlpm/akreditasi/sertifikat', [AkreditasiController::class, 'updatesertifikat'])->name('akreditasi.updatesertifikat');
    Route::resource('/adminlpm/dokumen-akreditasi', DokumenAkreditasiController::class)->except(['show', 'index']);

    Route::get('/adminlpm/identitas/edit', [IdentitasController::class, 'edit'])->name('identitas.edit');
    Route::get('/adminlpm/identitas/visimisi', [IdentitasController::class, 'visimisi'])->name('identitas.visimisi');
    Route::post('/adminlpm/identitas/visimisi', [IdentitasController::class, 'updatevisimisi'])->name('identitas.updatevisimisi');
    Route::get('/adminlpm/identitas/sejarah', [IdentitasController::class, 'sejarah'])->name('identitas.sejarah');
    Route::post('/adminlpm/identitas/sejarah', [IdentitasController::class, 'updatesejarah'])->name('identitas.updatesejarah');
    Route::get('/adminlpm/identitas/organisasi', [IdentitasController::class, 'organisasi'])->name('identitas.organisasi');
    Route::post('/adminlpm/identitas/organisasi', [IdentitasController::class, 'updateorganisasi'])->name('identitas.updateorganisasi');

    Route::resource('/adminlpm/auditis', AuditiController::class)->except(['show', 'index']);
    Route::resource('/adminlpm/jadwal-audits', JadwalAuditController::class)->except(['show', 'update', 'index']);
    Route::post('/adminlpm/jadwal-audits/update', [JadwalAuditController::class, 'update'])->name('jadwal-audits.update');
    Route::post('/adminlpm/monevs/update/{id}', [MonevController::class, 'update'])->name('monevs.update');
    Route::post('/adminlpm/dokumen-mutus/update/{id}', [DokumenMutuController::class, 'update'])->name('dokumen-mutus.update');
    Route::resource('/adminlpm/periodes', PeriodeController::class)->except(['show', 'index']);
    Route::resource('/adminlpm/auditors',  AuditorController::class)->except(['show', 'index']);
    Route::resource('/adminlpm/dokumen-mutus', DokumenMutuController::class)->except(['show', 'update', 'create']);
});
