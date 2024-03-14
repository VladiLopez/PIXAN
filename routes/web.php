<?php

use App\Http\Controllers\DetallesProductoController;
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

/*Route::get('/', function () {
    return view('index');
});*/

Route::get('/', function () {
    return view('index');
});

Route::resource('detallesproductos', DetallesProductoController::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/index', function () {
        return view('index');
    })->name('index');
});

Route::get('/usuarios', [UserController::class, 'mostrarUsuarios'])->name('usuarios.index');