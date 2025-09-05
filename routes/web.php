<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\AdvanceController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check() ? redirect('/dashboard') : redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('farmers', FarmerController::class);
    Route::resource('collections', CollectionController::class);
    Route::resource('advances', AdvanceController::class);
    Route::get('/reports/monthly', [ReportController::class, 'monthly'])->name('reports.monthly');
    Route::get('/reports/monthly/pdf', [ReportController::class, 'exportPdf'])->name('reports.monthly.pdf');
    Route::get('/reports/monthly/excel', [ReportController::class, 'exportExcel'])->name('reports.monthly.excel');
    Route::get('/reports/farmer/{farmer}/statement', [ReportController::class, 'farmerStatement'])->name('reports.farmer.statement');
});

require __DIR__.'/auth.php';
