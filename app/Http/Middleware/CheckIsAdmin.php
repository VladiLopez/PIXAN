<?php

namespace App\Http\Middleware;

use Closure;

class CheckIsAdmin
{
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->is_admin) {
            return $next($request);
        }

        abort(403, 'Acceso no autorizado.');
    }
}
