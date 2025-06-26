<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ZonaRiegoController;
use App\Http\Controllers\HorarioRiegoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegistroRiegoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Rutas que requieren autenticación
Route::middleware('auth')->group(function () {
    // Dashboard principal
    Route::get('/dashboard', function () {
        // Cargar alertas no leídas para el usuario actual
        $alertas = auth()->user()->alertas()->where('leida', false)->latest()->get();
        return view('dashboard', compact('alertas'));
    })->middleware(['verified'])->name('dashboard');

    // Rutas para el perfil de usuario (de Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas para Zonas de Riego (CRUD)
    Route::resource('zonas', ZonaRiegoController::class);

    // Rutas para Horarios de Riego (CRUD anidado en zonas)
    Route::resource('zonas.horarios', HorarioRiegoController::class)->except(['index', 'show'])->shallow();

    Route::resource('zonas.registros', RegistroRiegoController::class)->except(['index', 'show'])->shallow();

    // --- GRUPO DE RUTAS SOLO PARA ADMINS ---
    Route::middleware('admin')->group(function () {
        // El cambio está aquí: se excluyen las rutas 'create' y 'store' además de 'show'.
        Route::resource('users', UserController::class)->except(['show', 'create', 'store']);
    });

});

require __DIR__.'/auth.php';