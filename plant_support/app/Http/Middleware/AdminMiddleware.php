<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Revisa si el usuario está autenticado y si su rol es 'admin'
        if (auth()->check() && auth()->user()->rol == 'admin') {
            return $next($request); // Si es admin, permite continuar
        }

        // Si no es admin, redirige al dashboard con un mensaje de error.
        return redirect('/dashboard')->with('error', 'Acceso denegado. No tienes permisos de administrador.');
    }
}