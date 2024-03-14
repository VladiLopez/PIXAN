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

Route::get('/usuarios', [UserController::class, 'mostrarUsuarios'])->name('usuarios.index')->middleware('admin');