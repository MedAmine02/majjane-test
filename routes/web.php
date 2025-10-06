<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DossierController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DashboardController;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');



Route::middleware(['auth'])->group(function () {
    // dashboard avec statistiques
    Route::get('/dashboard-stats', [DashboardController::class, 'index'])->name('dashboard.stats');
    
    // clients
    Route::resource('clients', ClientController::class);
    
    // fossiers
    Route::resource('dossiers', DossierController::class);
    Route::post('/dossiers/{dossier}/status', [DossierController::class, 'updateStatus'])->name('dossiers.updateStatus');
    
    // documents
    Route::post('/dossiers/{dossier}/documents', [DocumentController::class, 'store'])->name('documents.store');
    Route::delete('/documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');
    Route::get('/documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');
});

require __DIR__.'/auth.php';



