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

        // Simplemente aborta la solicitud sin enviar ninguna respuesta
        abort(204); // Código de respuesta 204: No Content
    }
}
