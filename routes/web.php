<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ConfigController;
use Illuminate\Support\Facades\Route;

// Página inicial
Route::get('/', function () {
    return view('welcome');
});

// Rotas protegidas por autenticação
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Pacientes
    Route::prefix('/pacientes')->group(function () {
        Route::get('/', [PatientController::class, 'index'])->name('index.patient');
        Route::get('/dash/{id}', [PatientController::class, 'show'])->name('patients.show');
        Route::get('/{id}/edit', [PatientController::class, 'edit'])->name('patients.edit');
        Route::put('/{id}/update', [PatientController::class, 'update'])->name('patients.update');
    });

    // Prontuários
    Route::prefix('prontuarios')->group(function () {
        Route::get('/', [MedicalRecordController::class, 'index'])->name('index.medical-record');
        Route::get('/{id}', [MedicalRecordController::class, 'show'])->name('medical-records.show');
        Route::get('/{id}/edit', [MedicalRecordController::class, 'edit'])->name('medical-records.edit');
        Route::post('/{id}/upload', [MedicalRecordController::class, 'upload'])->name('medical-records.upload');
        Route::put('/{id}', [MedicalRecordController::class, 'update'])->name('medical-records.update');

        Route::put('/medical-records/{id}/save', [MedicalRecordController::class, 'save'])->name('medical-records.save');

        // Rotas para Sessões
        Route::post('/{id}/sessions', [SessionController::class, 'store'])->name('sessions.store');
        Route::get('/sessions/{id}', [SessionController::class, 'show'])->name('sessions.show');
        Route::put('/sessions/{id}', [SessionController::class, 'update'])->name('sessions.update');

        Route::get('/sessions/{id}', [SessionController::class, 'start'])->name('sessions.start');
        Route::get('/sessions/{id}/view/{file}', [SessionController::class, 'view'])->name('sessions.view');
        Route::post('/sessions/{id}/upload', [SessionController::class, 'upload'])->name('sessions.upload');
    });

    // Configurações
    Route::get('/configuracoes', [ConfigController::class, 'index'])->name('settings');

    // Perfil do usuário
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::get('/sessoes/{id}', [SessionController::class, 'show'])->name('session.show');
    Route::get('/sessoes/{id}/edit', [SessionController::class, 'edit'])->name('session.edit');
});

// Rotas de autenticação
require __DIR__.'/auth.php';

