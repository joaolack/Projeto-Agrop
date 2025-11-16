<?php

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::resource('produtos', ProdutoController::class)->middleware(['auth']);
Route::post('produtos/{produto}/move', [ProdutoController::class, 'moveEstoque'])
    ->name('produtos.moveEstoque');


require __DIR__.'/auth.php';
