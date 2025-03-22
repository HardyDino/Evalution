<?php

use App\Http\Controllers\BudgetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepenseController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/details/{type}/{id}', [DashboardController::class, 'details'])->name('details');
Route::resource('budgets', BudgetController::class);
Route::resource('depenses', DepenseController::class);
