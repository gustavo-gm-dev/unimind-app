<?php

use App\Http\Controllers\DashboardController;
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

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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
        Route::get('/{id}/edit', [MedicalRecordController::class, 'edit'])->name('medical-records.edit');
        Route::put('/medical-records/{id}/save', [MedicalRecordController::class, 'save'])->name('medical-records.save');
        //arquivo
        Route::post('/patients/{idPatient}/records/{idRecord}/upload', [MedicalRecordController::class, 'uploadFile'])->name('records.upload');
        Route::get('/patients/{idPatient}/records/{idRecord}/file/{fileId}', [MedicalRecordController::class, 'viewFile'])->name('records.view');

        //sessao
        Route::get('/sessao/{id}', [SessionController::class, 'start'])->name('sessions.start');
        Route::get('/sessao/start/{idMedicalRecord}', [SessionController::class, 'start'])->name('sessions.create');
        Route::get('/sessions/edit/{id}', [SessionController::class, 'edit'])->name('sessions.edit');
        Route::post('/sessao/save/{medicalRecord}', [SessionController::class, 'save'])->name('sessao.save');
    });

    // Configurações
    Route::get('/configuracoes', [ConfigController::class, 'index'])->name('settings');

    // Perfil do usuário
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

// Rotas de autenticação
require __DIR__.'/auth.php';

