<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

Route::resource('categories', CategoryController::class)->except('show');
Route::resource('roles', RoleController::class)->except('show');
Route::resource('customers', CustomerController::class)->except('show');