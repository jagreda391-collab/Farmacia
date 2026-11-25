<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// 1. RUTAS PÚBLICAS
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// 2. RUTAS PARA TODOS LOS LOGUEADOS (Cajero, Químico, Admin)
Route::middleware('auth')->group(function () {
    
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    
    // Clientes y Ventas: Todos pueden entrar
    Route::resource('customers', CustomerController::class)->except('show');
    Route::resource('sales', SaleController::class)->except('show');
    
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // 3. RUTAS PARA ADMIN Y QUÍMICO
    Route::middleware('role:Administrador,Químico farmacéutico')->group(function () {
        Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
        Route::resource('medicines', MedicineController::class)->except('show');
    });

    // 4. RUTAS SOLO PARA ADMINISTRADOR
    Route::middleware('role:Administrador')->group(function () {
        Route::resource('roles', RoleController::class)->except('show');
        Route::resource('users', UserController::class)->except('show');
        Route::resource('categories', CategoryController::class)->except('show');
        Route::resource('suppliers', SupplierController::class)->except('show');
    });
});