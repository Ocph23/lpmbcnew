<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AkreditasiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AuditScheduleController;
use App\Http\Controllers\AuditTeamController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StandarController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuditInstrumentController;
use App\Http\Controllers\AuditResultController;
use App\Http\Controllers\IdentitasController;
use App\Http\Controllers\LaporanController;

// Halaman Utama
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/akreditasi/institusi', [HomeController::class, 'institusi'])->name('akreditasi.institusi');
Route::get('/downloads', [HomeController::class, 'downloads'])->name('downloads');
Route::get('/sejarah', [HomeController::class, 'sejarah'])->name('sejarah');
Route::get('/visi', [HomeController::class, 'visi'])->name('visi');
Route::get('/struktur', [HomeController::class, 'struktur'])->name('struktur');
Route::view('/renker', 'renker')->name('renker');
Route::view('/spmi', 'spmi')->name('spmi');
Route::view('/spme', 'spme')->name('spme');
Route::view('/pusatdata', 'pusatdata')->name('pusatdata');
Route::view('/profile', 'profile')->name('profile');
Route::view('/settings', 'settings')->name('settings');

Route::get('/laporan/spmi', [HomeController::class, 'spmi'])->name('laporan.spmi');
Route::get('/laporan/spme', [HomeController::class, 'spme'])->name('laporan.spme');
Route::get('/laporan/pusatdata', [HomeController::class, 'pusatdata'])->name('laporan.pusatdata');


// Halaman Sambutan Detail
Route::view('/sambutan-detail', 'pages.sambutan-detail')->name('sambutan.detail');


// Autentikasi
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
// Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
// Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');
Route::get('/calendar', [AgendaController::class, 'index'])->name('calendar');

// Dashboard & protected routes
Route::middleware(['auth'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    // Profile & Settings
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/settings', [ProfileController::class, 'settings'])->name('settings');
    Route::post('/settings/password', [ProfileController::class, 'updatePassword'])->name('settings.password');

    // Akreditasi
    Route::get('/dashboard/akreditasidb', [AkreditasiController::class, 'index'])->name('dashboard.akreditasidb');
    Route::get('/dashboard/institusi', [AkreditasiController::class, 'institusi'])->name('dashboard.institusi');
    Route::post('/dashboard/akreditasidb/update', [AkreditasiController::class, 'update'])->name('dashboard.akreditasidb.update');
    Route::post('/dashboard/akreditasidb/updateinstitusi', [AkreditasiController::class, 'updateinstitusi'])->name('dashboard.akreditasidb.updateinstitusi');

    Route::resource('/admin/roles', RoleController::class);

    // Standar

    Route::resource('/admin/standars', StandarController::class);


    // Laporan

    Route::resource('/admin/laporans', LaporanController::class);
    Route::get('/laporan/{laporan}/download', [LaporanController::class, 'download'])->name('laporans.download');

    //unit
    Route::resource('/admin/units', UnitController::class); // optional: auth

    //documents

    // Route::resource('/admin/documents', DocumentController::class);
    // Route::get('/documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');


    //schedule
    Route::resource('/admin/audit-schedules', AuditScheduleController::class)
        ->parameters(['audit-schedules' => 'auditSchedule'])
    ;

    Route::resource('/admin/audit-instruments', AuditInstrumentController::class)
        ->parameters(['audit-instruments' => 'auditInstrument']);

    Route::prefix('/admin/audit-schedules/{auditSchedule}')->group(function () {
        Route::resource('teams', AuditTeamController::class)
            ->parameters(['teams' => 'team'])
        ;

        Route::resource('results', AuditResultController::class)
            ->parameters(['results' => 'result']);

        // Custom verification route (optional but useful)
        Route::post('/results/{result}/verify', [AuditResultController::class, 'verify'])
            ->name('audit-schedules.results.verify');
    });

    // Agenda
    Route::resource('agenda', AgendaController::class)->except(['create', 'show']);
    Route::get('/agenda/list', [AgendaController::class, 'list'])->name('agenda.list');
});

// Route::middleware(['auth'])->group(function () {
//     Route::resource('users',  UserController::class);
// });

include 'adminlpm.php';
