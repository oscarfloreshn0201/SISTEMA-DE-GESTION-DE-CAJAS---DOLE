<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CajaController;
use App\Http\Controllers\BatchController;

// Rutas de autenticación
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/register', [UserController::class, 'create'])->name('register');
Route::post('/register', [UserController::class, 'store'])->name('register.store');
// Rutas de usuarios (TODAS las rutas CRUD)
Route::resource('users', UserController::class);

// Rutas de cajas
Route::resource('cajas', CajaController::class);

// Rutas de batches
Route::get('/batches/create', [BatchController::class, 'create'])->name('batches.create');
Route::post('/batches', [BatchController::class, 'store'])->name('batches.store');
Route::get('/batches/search', [BatchController::class, 'search'])->name('batches.search');
Route::get('/batches/{batch}', [BatchController::class, 'show'])->name('batches.show');
Route::get('/batches/{batch}/edit', [BatchController::class, 'edit'])->name('batches.edit');
Route::put('/batches/{batch}', [BatchController::class, 'update'])->name('batches.update');
Route::delete('/batches/{batch}', [BatchController::class, 'destroy'])->name('batches.destroy');

// Dashboard (protegido)
Route::get('/dashboard', function () {
    if (!Auth::check()) {
        return redirect('/login');
    }
    return view('dashboard');
})->name('dashboard');

// Ruta principal
Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return redirect('/login');
});