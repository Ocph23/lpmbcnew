<?php

use App\Http\Controllers\AdminLPM\AdminNewsController;
use App\Http\Controllers\AdminLPM\AkreditasiController;
use App\Http\Controllers\AdminLPM\AuditiController;
use App\Http\Controllers\AdminLPM\AuditorController;
use App\Http\Controllers\AdminLPM\CalendarAcademicController;
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

Route::get('/layananlpm', function () {
    return Inertia::render('Home', []);
})->name('layananlpm');

Route::get('/layananlpm/akreditasi', [AkreditasiController::class, 'index'])->name('akreditasi.index');
Route::get('/layananlpm/akreditasi/sertifikat', [AkreditasiController::class, 'sertifikat'])->name('akreditasi.sertifikat');
Route::get('/layananlpm/periodes', [PeriodeController::class, 'index'])->name('periodes.index');
Route::get('/layananlpm/dokumen-mutus/{param}', [DokumenMutuController::class, 'filter'])->name('dokumen-mutus.filter');
Route::get('/layananlpm/dokumen-mutus/create/{param}', [DokumenMutuController::class, 'create'])->name('dokumen-mutus.create');
Route::get('/layananlpm/auditis', [AuditiController::class, 'index'])->name('auditis.index');
Route::get('/layananlpm/jadwal-audits', [JadwalAuditController::class, 'index'])->name('jadwal-audits.index');
Route::get('/layananlpm/hasil-audits', [JadwalAuditController::class, 'hasil'])->name('jadwal-audits.hasil');
Route::get('/layananlpm/auditors', [AuditorController::class, 'index'])->name('auditors.index');
Route::get('/layananlpm/monevs/akademik', [MonevController::class, 'akademik'])->name('monevs.akademik');
Route::get('/layananlpm/monevs/non-akademik', [MonevController::class, 'nonakademik'])->name('monevs.nonakademik');
Route::get('/layananlpm/dokumen-akreditasi', [DokumenAkreditasiController::class, 'index'])->name('dokumen-akreditasi.index');
Route::get('/layananlpm/instrumen-akreditasis', [InstrumenAkreditasiController::class, 'index'])->name('instrumen-akreditasis.index');
Route::get('/layananlpm/documents/{param}', [DocumentController::class, 'index'])->name('documents.index');
Route::get('/layananlpm/documents/create/{param}', [DocumentController::class, 'create'])->name('documents.create');
Route::get('/layananlpm/calendars', [CalendarAcademicController::class, 'index'])->name('calendars.index');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('/layananlpm/news', AdminNewsController::class)->except(['update']);
    Route::post('/layananlpm/news/update/{id}', [AdminNewsController::class, 'update'])->name('news.update');
    Route::resource('/layananlpm/calendars', CalendarAcademicController::class)->except(['show', 'index']);
    Route::resource('/layananlpm/documents', DocumentController::class)->except(['show', 'index', 'create']);
    Route::post('/layananlpm/documents/update/{id}', [DocumentController::class, 'update'])->name('documents.updatepost');
    Route::resource('/layananlpm/instrumen-akreditasis', InstrumenAkreditasiController::class)->except(['index', 'show']);
    Route::post('/layananlpm/instrumen-akreditasis/update/{id}', [InstrumenAkreditasiController::class, 'update'])->name('instrumen-akreditasis.updatepost');
    Route::resource('/layananlpm/monevs', MonevController::class)->except(['show', 'index', 'akademik', 'nonakademik']);
    Route::resource('/layananlpm/users', UserController::class);
    Route::post('/layananlpm/akreditasi', [AkreditasiController::class, 'update'])->name('akreditasi.update');
    Route::post('/layananlpm/akreditasi/sertifikat', [AkreditasiController::class, 'updatesertifikat'])->name('akreditasi.updatesertifikat');
    Route::resource('/layananlpm/dokumen-akreditasi', DokumenAkreditasiController::class)->except(['show', 'index']);

    Route::get('/layananlpm/identitas/edit', [IdentitasController::class, 'edit'])->name('identitas.edit');
    Route::get('/layananlpm/identitas/visimisi', [IdentitasController::class, 'visimisi'])->name('identitas.visimisi');
    Route::post('/layananlpm/identitas/visimisi', [IdentitasController::class, 'updatevisimisi'])->name('identitas.updatevisimisi');
    Route::get('/layananlpm/identitas/sejarah', [IdentitasController::class, 'sejarah'])->name('identitas.sejarah');
    Route::post('/layananlpm/identitas/sejarah', [IdentitasController::class, 'updatesejarah'])->name('identitas.updatesejarah');
    Route::get('/layananlpm/identitas/organisasi', [IdentitasController::class, 'organisasi'])->name('identitas.organisasi');
    Route::post('/layananlpm/identitas/organisasi', [IdentitasController::class, 'updateorganisasi'])->name('identitas.updateorganisasi');

    Route::resource('/layananlpm/auditis', AuditiController::class)->except(['show', 'index']);
    Route::resource('/layananlpm/jadwal-audits', JadwalAuditController::class)->except(['show', 'update', 'index']);
    Route::post('/layananlpm/jadwal-audits/update', [JadwalAuditController::class, 'update'])->name('jadwal-audits.update');
    Route::post('/layananlpm/monevs/update/{id}', [MonevController::class, 'update'])->name('monevs.update');
    Route::post('/layananlpm/dokumen-mutus/update/{id}', [DokumenMutuController::class, 'update'])->name('dokumen-mutus.update');
    Route::resource('/layananlpm/periodes', PeriodeController::class)->except(['show', 'index']);
    Route::resource('/layananlpm/auditors',  AuditorController::class)->except(['show', 'index']);
    Route::resource('/layananlpm/dokumen-mutus', DokumenMutuController::class)->except(['show', 'update', 'create']);
});
