<?php

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::resource('produtos', ProdutoController::class)->middleware(['auth']);



require __DIR__.'/auth.php';
