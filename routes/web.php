<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DocumentViewController;
use App\Livewire\DocumentManager;
use App\Livewire\AdminPagos;
use App\Livewire\AdminUsers;
use App\Livewire\AdminCatalogo;
use App\Livewire\HistorialPagos;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - SISTEMA MARVINPROYECTO
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/**
 * GRUPO DE SEGURIDAD TOTAL
 * 'auth' -> Verifica que esté logueado.
 * 'verified' -> Verifica correo (si aplica).
 * \App\Http\Middleware\CheckUserStatus::class -> ¡ESTA ES LA LLAVE! 
 * Si el status es 0, este middleware lo sacará antes de que cargue cualquier página.
 */
Route::middleware(['auth', 'verified', \App\Http\Middleware\CheckUserStatus::class])->group(function () {
    
    // DASHBOARD PRINCIPAL
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // PORTAL DEL USUARIO
    Route::get('/documentos', DocumentManager::class)->name('documentos');
    Route::get('/ver-documento/{id}', [DocumentViewController::class, 'show'])->name('ver.documento');

    // TRAZABILIDAD FINANCIERA
    Route::get('/historial-pagos', HistorialPagos::class)->name('historial.pagos');

    // PANEL ADMINISTRATIVO
    Route::get('/admin/pagos', AdminPagos::class)->name('admin.pagos');
    Route::get('/admin/usuarios', AdminUsers::class)->name('admin.usuarios');
    Route::get('/admin/catalogo', AdminCatalogo::class)->name('admin.catalogo');

    // RUTAS DE PERFIL
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';