<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChamadaController;

Route::middleware(['auth'])->group(function () {
    // Rotas do usuário com resource
    Route::resource('chamadas', ChamadaController::class);

    // Rota para concluir uma chamada
    Route::put('chamadas/{id}/concluir', [ChamadaController::class, 'concluir'])->name('chamadas.concluir');

    // Rotas do perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/chamadas/{id}/arquivo', [ChamadaController::class, 'visualizarAnexo'])
        ->name('chamadas.visualizar_anexo');
});

// Rotas do admin
Route::middleware(['auth', 'can:is-admin'])->prefix('admin')->group(function () {
    // Listar usuários
    Route::get('/usuarios', [AdminController::class, 'index'])->name('admin.usuarios.index');

    // Criar um novo usuário (formulário)
    Route::get('/usuarios/create', [AdminController::class, 'create'])->name('admin.usuarios.create');

    // Salvar um novo usuário
    Route::post('/usuarios', [AdminController::class, 'store'])->name('admin.usuarios.store');

    // Atualizar o papel de um usuário
    Route::patch('/usuarios/{id}/role', [AdminController::class, 'updateRole'])->name('admin.usuarios.updateRole');

    // Gerenciamento de chamadas
    Route::get('/chamadas', [AdminController::class, 'listarChamadas'])->name('admin.chamadas');
});

// Rota inicial
Route::get('/', function () {
    return redirect('dashboard');
});

// Autenticação
require __DIR__ . '/auth.php';
