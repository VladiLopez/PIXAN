<?php

<<<<<<< Updated upstream
=======
use App\Http\Controllers\DetallesProductoController;
use App\Http\Controllers\MaterialesController;
use App\Http\Controllers\UserController;
>>>>>>> Stashed changes
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

Route::get('/', function () {
    return view('welcome');
});
<<<<<<< Updated upstream
=======

Route::resource('stockmateriales', MaterialesController::class);

Route::get('/usuarios', [UserController::class, 'mostrarUsuarios'])
    ->name('usuarios.index')
    ->middleware('auth','admin');

Route::get('/ViewUsuario/{id}', [UserController::class, 'mostrarUsuarioEsp'])
    ->name('usuarios.show')
    ->middleware('auth','admin');

Route::get('/usuarios/edit/{id}', [UserController::class, 'editarUsuario'])
    ->name('usuarios.edit')
    ->middleware('auth','admin');

Route::put('/usuarios/{id}', [UserController::class, 'actualizarUsuario'])
    ->name('usuarios.update')
    ->middleware('auth','admin');

Route::get('/stockmateriales', [MaterialesController::class, 'index'])
    ->name('stockmateriales.index')
    ->middleware('auth', 'admin');

Route::get('/stockmateriales/create', [MaterialesController::class, 'create'])
    ->name('stockmateriales.create')
    ->middleware('auth', 'admin');

Route::get('/stockmateriales/show/{id}', [MaterialesController::class, 'show'])
    ->name('stockmateriales.show')
    ->middleware('auth', 'admin');
>>>>>>> Stashed changes
