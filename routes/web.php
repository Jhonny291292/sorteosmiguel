<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RifaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VentasController;
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
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/home', [RifaController::class, 'list'])->name('home');
    Route::get('/rifa', [RifaController::class, 'list'])->name('rifa.list');
    Route::get('/clientes', [ClienteController::class, 'list'])->name('clientes.list');
    Route::get('/pagos', [PagoController::class, 'list'])->name('pagos.list');
    Route::get('/usuarios', [UserController::class, 'list'])->name('usuarios.list');
    Route::get('/ventas', [VentasController::class, 'list'])->name('ventas.list');
});

// require __DIR__.'/auth.php';
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
