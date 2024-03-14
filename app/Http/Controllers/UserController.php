<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function mostrarUsuarios()
    {
        $usuarios = User::all();
        return view('usuarios', ['usuarios' => $usuarios]);
    }
}
