<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlimentoController;
Route::get('/alimentos', [AlimentoController::class, 'index'])->name('alimentos.index');
Route::get('/alimentos/create', [AlimentoController::class, 'create'])->name('alimentos.create');
Route::post('/alimentos', [AlimentoController::class, 'store'])->name('alimentos.store');
Route::get('/alimentos/{alimento}/edit', [AlimentoController::class, 'edit'])->name('alimentos.edit');
Route::put('/alimentos/{alimento}', [AlimentoController::class, 'update'])->name('alimentos.update');
Route::delete('/alimentos/{alimento}', [AlimentoController::class, 'destroy'])->name('alimentos.destroy');


Route::resource('alimentos', AlimentoController::class);
Route::get('/alimentos/validade-proxima', [AlimentoController::class, 'validadeProxima'])->name('alimentos.validade_proxima');
Route::get('/alimentos/estoque-baixo', [AlimentoController::class, 'estoqueBaixo'])->name('alimentos.estoque_baixo');


Route::get('/alimentos/estoque-baixo', [AlimentoController::class, 'estoqueBaixo'])->name('alimentos.estoque_baixo');


Route::get('/', function () {
    return view('welcome');



Route::get('/alimentos/estoque-baixo', [AlimentoController::class, 'estoqueBaixo'])->name('alimentos.estoque_baixo');

});

