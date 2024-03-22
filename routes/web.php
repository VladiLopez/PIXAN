<?php

use App\Http\Controllers\DetallesProductoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
    if (Auth::check()) {
        if (Auth::user()->is_admin) {
            return view('indexUsers');
        } else {
            return view('index');
        }
    } else {
        return view('inicio');
    }
});


Route::resource('detallesproductos', DetallesProductoController::class);

Route::get('/usuarios', [UserController::class, 'mostrarUsuarios'])->name('usuarios.index')->middleware('auth','admin');

Route::get('/ViewUsuario/{id}', [UserController::class, 'mostrarUsuarioEsp'])->name('usuarios.show')->middleware('auth','admin');

Route::get('/usuarios/edit/{id}', [UserController::class, 'editarUsuario'])->name('usuarios.edit');

Route::put('/usuarios/{id}', [UserController::class, 'actualizarUsuario'])->name('usuarios.update');


Route::get('/detallesproductos', [DetallesProductoController::class, 'index'])
    ->name('detallesproductos.index')
    ->middleware('auth', 'admin');

Route::get('/detallesproductos/create', [DetallesProductoController::class, 'create'])
    ->name('detallesproductos.create')
    ->middleware('auth', 'admin');

Route::get('/detallesproductos/show/{id}', [DetallesProductoController::class, 'show'])
    ->name('detallesproductos.show')
    ->middleware('auth', 'admin');

Route::get('/detallesproductos/edit/{id}', [DetallesProductoController::class, 'edit'])
    ->name('detallesproductos.edit')
    ->middleware('auth', 'admin');

    Route::delete('/detallesproductos/{id}', [DetallesProductoController::class, 'destroy'])
    ->name('detallesproductos.destroy')
    ->middleware('auth', 'admin');

Route::put('/detallesproductos/update/{id}', [DetallesProductoController::class, 'update'])
    ->name('detallesproductos.update')
    ->middleware('auth', 'admin');

Route::get('/catalogo', [DetallesProductoController::class, 'catalogo'])->name('catalogo.productos');
Route::get('/detallesCatalogo/{id}', [DetallesProductoController::class, 'detallesCatalogo'])->name('detallesCatalogo.productos');
