<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\EventosController;

Route::get('/', [EventosController::class, 'index']);
Route::post('/eventos', [EventosController::class, 'store']);
Route::get('/eventos/criar', [EventosController::class, 'create'])->middleware('auth');
Route::get('/eventos/{id}', [EventosController::class, 'show']);
Route::delete('/eventos/{id}', [EventosController::class, 'destroy'])->middleware('auth');
Route::put('/eventos/update/{id}', [EventosController::class, 'update'])->middleware('auth');
Route::post('/eventos/join/{id}', [EventosController::class, 'joinEvento'])->middleware('auth');
Route::delete('/eventos/leave/{id}', [EventosController::class, 'leaveEvento'])->middleware('auth');
Route::get('/dashboard', [EventosController::class, 'dashboard'])->middleware('auth');

// Route::get('/eventos/edit/{id}', [EventosController::class, 'edit'])->middleware('auth');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return redirect('/dashboard');
// })->name('dashboard');
