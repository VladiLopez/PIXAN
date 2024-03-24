<?php
<<<<<<< HEAD
use App\Http\Controllers\InventarioController;
=======

>>>>>>> 9ef4fb24689f3c94f968d82e094c38d8078c75f3
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
<<<<<<< HEAD
    return view('index');
});

Route::resource('detallesinventario', InventarioController::class);
=======
    return view('welcome');
});
>>>>>>> 9ef4fb24689f3c94f968d82e094c38d8078c75f3
