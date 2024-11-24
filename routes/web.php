<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\SchedulingController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;

// Página inicial
Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['role' => CheckRole::class]);

// Rotas protegidas por autenticação
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Pacientes
    Route::prefix('/pacientes')->group(function () {
        Route::get('/', [PatientController::class, 'index'])->name('index.patient');
        Route::get('/dash/{id}', [PatientController::class, 'show'])->name('patients.show');
        Route::get('/{id}/edit', [PatientController::class, 'edit'])->name('patients.edit');
        Route::put('/{id}/update', [PatientController::class, 'update'])->name('patients.update');
        Route::get('/create', [PatientController::class, 'create'])->name('patients.create');
        Route::post('/store', [PatientController::class, 'store'])->name('patients.store');
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
        Route::get('/sessoes', [SessionController::class, 'index'])->name('session.index');
        Route::get('/sessao/create/{prontuario_id}', [SessionController::class, 'create'])->name('session.create');
        Route::post('/sessao', [SessionController::class, 'store'])->name('session.store');
        Route::get('/sessao/{sessao_id}', [SessionController::class, 'show'])->name('session.show');
        Route::get('/sessao/{sessao_id}/edit', [SessionController::class, 'edit'])->name('session.edit');
        Route::put('/sessao/{sessao_id}', [SessionController::class, 'update'])->name('session.update');
    });

    // Configurações
    Route::get('/configuracoes', [ConfigController::class, 'index'])->name('settings');

    // Perfil do usuário
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    //Agendamento
    Route::prefix('scheduling')->group(function () {
        Route::get('create/{id}', [SchedulingController::class, 'create'])->name('scheduling.create');
        Route::post('store/{id}', [SchedulingController::class, 'store'])->name('scheduling.store');
        Route::get('edit/{id}', [SchedulingController::class, 'edit'])->name('scheduling.edit');
        Route::post('update/{id}', [SchedulingController::class, 'update'])->name('scheduling.update');
    });
});

// Rotas de autenticação
require __DIR__.'/auth.php';

