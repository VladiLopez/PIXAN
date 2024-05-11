<?php

use App\Http\Controllers\DetallesProductoController;
use App\Http\Controllers\MaterialesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PedidoController;
use App\Mail\CorreoMailable;
use App\Models\Pedido;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
Route::resource('stockmateriales', MaterialesController::class)->middleware('auth');

Route::get('/usuarios', [UserController::class, 'mostrarUsuarios'])
    ->name('usuarios.index')
    ->middleware('auth','admin');

Route::get('/ViewUsuario/{id}', [UserController::class, 'mostrarUsuarioEsp'])
    ->name('usuarios.show')
    ->middleware('auth');

Route::get('/mi-perfil', [UserController::class, 'MiPerfil'])->name('mi.perfil')->middleware('auth');

Route::get('/usuarios/edit/{id}', [UserController::class, 'editarUsuario'])
    ->name('usuarios.edit')
    ->middleware('auth','admin');

Route::put('/usuarios/{id}', [UserController::class, 'actualizarUsuario'])
    ->name('usuarios.update')
    ->middleware('auth','admin');

Route::delete('/usuarios/{id}', [UserController::class, 'destroy'])
    ->name('usuarios.destroy')
    ->middleware('auth','admin');

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

Route::get('/stockmateriales', [MaterialesController::class, 'index'])
    ->name('stockmateriales.index')
    ->middleware('auth', 'admin');

Route::get('/stockmateriales/create', [MaterialesController::class, 'create'])
    ->name('stockmateriales.create')
    ->middleware('auth', 'admin');

Route::get('/stockmateriales/show/{id}', [MaterialesController::class, 'show'])
    ->name('stockmateriales.show')
    ->middleware('auth', 'admin');

Route::get('/catalogo', [DetallesProductoController::class, 'catalogo'])
    ->name('catalogo.productos')
    ->middleware('auth');

Route::get('/catalogoNotUser', [DetallesProductoController::class, 'catalogoNotUser'])->name('catalogoNotUser.productos');
Route::get('/detallesCatalogo/{id}', [DetallesProductoController::class, 'detallesCatalogo'])->name('detallesCatalogo.productos');

Route::get('/detallesCatalogo/{id}/comentarios', [DetallesProductoController::class, 'mostrarComentarios'])->name('detallesCatalogo.comentarios')->middleware('auth');
Route::post('/detallesCatalogo/agregar/{id}', [DetallesProductoController::class, 'agregar'])->name('comentario.agregar')->middleware('auth');

// En tu archivo de rutas web.php
Route::post('/agregarAlCarrito', [CarritoController::class, 'agregarAlCarrito'])
    ->name('agregarAlCarrito')
    ->middleware('auth');

Route::get('/carrito-compras', [CarritoController::class, 'verCarrito'])
    ->name('verCarrito')
    ->middleware('auth'); // Solo usuarios autenticados pueden ver el carrito

Route::delete('/carrito-compras/{carritoId}', [CarritoController::class, 'eliminarDelCarrito'])
    ->name('carrito.eliminar')
    ->middleware('auth');

Route::post('/realizar-pedido', [PedidoController::class, 'realizarPedido'])->name('pedido.realizar')->middleware('auth');
Route::get('/confirmacion-pedido', [PedidoController::class, 'confirmacionPedido'])->name('confirmacion.pedido')->middleware('auth');
Route::get('pedidos', [PedidoController::class, 'listarPedidos'])->name('pedidos.listar');