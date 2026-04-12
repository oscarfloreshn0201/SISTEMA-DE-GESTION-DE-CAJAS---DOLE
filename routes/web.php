<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CajaController;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\BatchController;

// ============================================
// RUTAS DE AUTENTICACIÓN (UserController)
// ============================================
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

// ============================================
// DASHBOARD
// ============================================
Route::get('/dashboard', function () {
    if (!Auth::check()) {
        return redirect('/login');
    }
    return view('dashboard');
})->name('dashboard');

// ============================================
// RUTAS DE CAJAS (CajaController)
// ============================================
Route::get('/cajas', [CajaController::class, 'index'])->name('cajas.index');
Route::get('/cajas/create', [CajaController::class, 'create'])->name('cajas.create');
Route::post('/cajas', [CajaController::class, 'store'])->name('cajas.store');
Route::get('/cajas/{caja}', [CajaController::class, 'show'])->name('cajas.show');
Route::get('/cajas/{caja}/edit', [CajaController::class, 'edit'])->name('cajas.edit');
Route::put('/cajas/{caja}', [CajaController::class, 'update'])->name('cajas.update');
Route::delete('/cajas/{caja}', [CajaController::class, 'destroy'])->name('cajas.destroy');

// ============================================
// RUTAS DE BATCHES (BatchController)
// ============================================
Route::get('/batches/create', [BatchController::class, 'create'])->name('batches.create');
Route::post('/batches', [BatchController::class, 'store'])->name('batches.store');
Route::get('/batches/{batch}', [BatchController::class, 'show'])->name('batches.show');
Route::get('/batches/{batch}/edit', [BatchController::class, 'edit'])->name('batches.edit');
Route::put('/batches/{batch}', [BatchController::class, 'update'])->name('batches.update');
Route::delete('/batches/{batch}', [BatchController::class, 'destroy'])->name('batches.destroy');
// Búsqueda de batches
Route::get('/batches/search', [BatchController::class, 'search'])->name('batches.search');

// ============================================
// RUTA PRINCIPAL (redirige a login o dashboard)
// ============================================
Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return redirect('/login');
});