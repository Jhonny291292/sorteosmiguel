<?php

use App\Http\Controllers\EmergenciasController;
use App\Http\Controllers\frenteController;
use App\Http\Controllers\organismosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('auth/login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/emergencias', [EmergenciasController::class, 'list'])->name('emergencias.list');
    Route::get('/frentes', [frenteController::class, 'list'])->name('frentes.list');
    Route::get('/organismos', [organismosController::class, 'list'])->name('organismos.list');
    Route::get('/usuarios', [UserController::class, 'list'])->name('usuarios.list');
});

// require __DIR__.'/auth.php';
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
