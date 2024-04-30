<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->is_admin) {
            //return redirect('error403'); // Redirige a la raíz de la aplicación
            return response()->view('errors.403', [], 403);
        }

        return $next($request);
    }
}
