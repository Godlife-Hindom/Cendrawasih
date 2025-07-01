<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\UserAlternativeController;
use App\Http\Controllers\UserMapController;
use App\Http\Controllers\ARASController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\GeoTiffController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\SubcriteriaController;
use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\UserCriteriaController;

Route::middleware(['auth', 'is_pimpinan'])->prefix('pimpinan')->group(function () {
    Route::get('/dashboard', [PimpinanController::class, 'index'])->name('pimpinan.dashboard');
    Route::get('/filter', [PimpinanController::class, 'filter'])->name('pimpinan.filter');
    Route::get('/peta', [PimpinanController::class, 'showMap'])->name('pimpinan.peta');
    Route::get('/pesan', [ReportController::class, 'messages'])->name('pimpinan.pesan');
    Route::get('/pimpinan/laporan/{id}/show', [ReportController::class, 'viewMessage'])->name('pimpinan.viewMessage');
    Route::get('/pesan/{id}', [ReportController::class, 'viewMessage'])->name('pimpinan.pesan.detail');
    //Route::post('/evaluasi/{id}', [PimpinanController::class, 'evaluate'])->name('pimpinan.evaluasi');
    Route::get('/evaluasi/{id}', [ReportController::class, 'evaluate'])->name('pimpinan.evaluasi');
    Route::get('/pimpinan/evaluasi/{id}', [ReportController::class, 'showEvaluateForm'])->name('pimpinan.evaluasi');
    Route::post('/pimpinan/evaluasi/{id}', [ReportController::class, 'evaluate'])->name('pimpinan.submitEvaluasi');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/{id}', [ReportController::class, 'show'])->name('reports.show');
    Route::post('/reports/{id}/evaluate', [ReportController::class, 'evaluate'])->name('reports.evaluate');
    Route::get('/pimpinan/laporan', [ReportController::class, 'laporan'])->name('pimpinan.laporan');
    Route::delete('/pimpinan/laporan/{id}', [ReportController::class, 'deleteLaporan'])->name('pimpinan.deleteLaporan');
    Route::get('/feedback', [PimpinanController::class, 'feedbackForm'])->name('pimpinan.feedback');
    Route::post('/feedback', [PimpinanController::class, 'submitFeedback'])->name('pimpinan.feedback.store');
});


Route::middleware(['auth', 'is_admin'])->group(function () {
    //kriteria
    Route::get('/criteria', [CriteriaController::class, 'index'])->name('criteria.index');
    Route::get('/criteria/create', [CriteriaController::class, 'create'])->name('criteria.create'); // <--- ini yang perlu
    Route::post('/criteria', [CriteriaController::class, 'store'])->name('criteria.store');
    Route::resource('criteria', CriteriaController::class);
    Route::get('/criteria/{criteria}/subcriterias', [SubcriteriaController::class, 'index'])->name('subcriterias.index');
    Route::get('/criteria/{criteria}/subcriterias/create', [SubcriteriaController::class, 'create'])->name('subcriterias.create');
    Route::post('/criteria/{criteria}/subcriterias', [SubcriteriaController::class, 'store'])->name('subcriterias.store');
    Route::get('/criteria/{criteria}/subcriterias/{subcriteria}/edit', [SubcriteriaController::class, 'edit'])->name('subcriterias.edit');
    Route::put('/criteria/{criteria}/subcriterias/{subcriteria}', [SubcriteriaController::class, 'update'])->name('subcriterias.update');
    Route::delete('/criteria/{criteria}/subcriterias/{subcriteria}', [SubcriteriaController::class, 'destroy'])->name('subcriterias.destroy');


    //alternative
    Route::get('/alternatives', [AlternativeController::class, 'index'])->name('alternatives.index');
    Route::resource('alternatives', AlternativeController::class);

    //map
    //Route::get('/map', [ARASController::class, 'calculate'])->name('map');
    Route::get('/aras/{userId}', [ARASController::class, 'calculate'])->name('aras.calculate');
    Route::get('/map', [DashboardController::class, 'showMap'])->name('map.show');
    //Route::get('/map', [DashboardController::class, 'showMap'])->name('map.view');
    Route::post('/dashboard/send-report', [DashboardController::class, 'sendReport'])->name('dashboard.sendReport');
    Route::get('/admin/laporan', [LaporanController::class, 'index'])->name('admin.laporan.index');
    Route::get('/laporan/semua/{id}', [LaporanController::class, 'showByUser'])->name('admin.laporan.semua');
    Route::delete('/laporan/semua/{id}', [LaporanController::class, 'destroy'])->name('admin.laporan.destroy');
    Route::delete('/admin/users/{id}', [DashboardController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/feedback', [DashboardController::class, 'feedbackForm'])->name('feedback.form');
    Route::post('/feedback', [DashboardController::class, 'submitFeedback'])->name('feedback.store');

    //Route::get('/laporan/{id}', [LaporanController::class, 'show'])->name('laporan.show');

});

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Dashboard Admin (jika kamu punya)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Route untuk login & register
require __DIR__.'/auth.php';

// Route umum untuk profile user
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ================= USER ROUTES =================

Route::middleware(['auth', 'is_user'])->prefix('user')->name('user.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    //kriteia
    Route::get('/user/criteria', [UserCriteriaController::class, 'index'])->name('criteria.index');

    // Alternatif lokasi
    Route::get('/alternatives', [UserAlternativeController::class, 'index'])->name('alternatives.index');
    Route::get('/alternatives/create', [UserAlternativeController::class, 'create'])->name('alternatives.create');
    Route::post('/alternatives', [UserAlternativeController::class, 'store'])->name('alternatives.store');
    Route::get('/alternatives/{alternative}/edit', [UserAlternativeController::class, 'edit'])->name('alternatives.edit');
    Route::put('/alternatives/{alternative}', [UserAlternativeController::class, 'update'])->name('alternatives.update');
    Route::delete('/alternatives/{alternative}', [UserAlternativeController::class, 'destroy'])->name('alternatives.destroy');


    // Perhitungan ARAS
    Route::post('/calculate', [UserAlternativeController::class, 'calculate'])->name('calculate.aras');

    // Peta
    Route::get('/view-map', [UserMapController::class, 'index'])->name('view-map');

    Route::get('/geotiff-values', [GeoTiffController::class, 'getGeoTiffValues'])->name('geo.fetch');
    Route::get('/api/environmental-data', [UserDashboardController::class, 'getEnvironmentalData'])->name('api.environmental-data');
    Route::post('/laporan/kirim', [LaporanController::class, 'store'])->name('laporan.kirim')->middleware('auth');
    Route::get('/feedback', [FeedbackController::class, 'form'])->name('feedback.form');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.submit');
    
});

Route::get('/fetch', [GeoTiffController::class, 'fetch'])->name('geo.fetch');
Route::get('/api/environmental-data', [UserDashboardController::class, 'getEnvironmentalData'])->name('api.environmental-data');


