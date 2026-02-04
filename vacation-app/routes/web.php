<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\VacacionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Route::get('/', [VacacionController::class, 'index'])->name('vacaciones.index');
Route::get('/vacacion/{id}', [VacacionController::class, 'show'])->name('vacaciones.show');

Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/home/edit', [HomeController::class, 'edit'])->name('home.edit');
Route::put('/home/update', [HomeController::class, 'update'])->name('home.update');

Route::middleware(['auth'])->group(function () {
    Route::post('/reserva', [ReservaController::class, 'store'])->name('reservas.store');
    Route::get('/mis-reservas', [ReservaController::class, 'index'])->name('reservas.index');
    Route::delete('/reserva/{id}', [ReservaController::class, 'destroy'])->name('reservas.destroy');

    Route::post('/comentario', [ComentarioController::class, 'store'])->name('comentarios.store');
    Route::put('/comentario/{id}', [ComentarioController::class, 'update'])->name('comentarios.update');
    Route::delete('/comentario/{id}', [ComentarioController::class, 'destroy'])->name('comentarios.destroy');

    Route::get('/admin', [AdminController::class, 'dashboard'])->middleware('checkRole:admin,advanced')->name('admin.dashboard');
    Route::resource('user', \App\Http\Controllers\UserController::class);

    Route::middleware(['checkRole:admin,advanced'])->group(function () {
        Route::get('/vacaciones/manage', [VacacionController::class, 'adminIndex'])->name('vacaciones.admin_index');
        Route::get('/vacaciones/create', [VacacionController::class, 'create'])->name('vacaciones.create');
        Route::post('/vacaciones', [VacacionController::class, 'store'])->name('vacaciones.store');
        Route::get('/vacaciones/{id}/edit', [VacacionController::class, 'edit'])->name('vacaciones.edit');
        Route::put('/vacaciones/{id}', [VacacionController::class, 'update'])->name('vacaciones.update');
        Route::delete('/vacaciones/{id}', [VacacionController::class, 'destroy'])->name('vacaciones.destroy');
    });
});

