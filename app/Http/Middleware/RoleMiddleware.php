<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Verifica que el usuario autenticado tenga uno de los roles indicados.
     * Uso en rutas: ->middleware('role:Administrador,Químico farmacéutico')
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!auth()->check() || !auth()->user()->hasAnyRole($roles)) {
            abort(403, 'No tienes permiso para acceder a esta sección.');
        }

        return $next($request);
    }
}