<?php

use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\PerguntasController;
use App\Http\Controllers\PiramideController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParticipanteController;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('auth.login');
});

Route::get('/home', [ParticipanteController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/participantes', [ParticipanteController::class, 'store'])->name('participante.store');


    Route::get('/tempo-piramide/{id}', [PiramideController::class, 'index'])->name('piramide.index');
    Route::post('/tempo-piramide/salvar', [PiramideController::class, 'store'])->name('piramide.store');


    Route::get('/quiz/{id}', [PerguntasController::class, 'index'])->name('pergunta.index');
    Route::post('/quiz/salvar', [PerguntasController::class, 'store'])->name('pergunta.store');

    Route::get('/estoque', action: [EstoqueController::class, 'index'])->name('estoque.index');
    Route::post('/estoque', action: [EstoqueController::class, 'store'])->name('estoque.store');
    Route::post('/estoque/remover', action: [EstoqueController::class, 'remover'])->name('estoque.remover');
    Route::delete('/estoque/{id}', action: [EstoqueController::class, 'destroy'])->name('estoque.destroy');






});

require __DIR__ . '/auth.php';
