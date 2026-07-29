<?php

namespace App\Http\Middleware;

use Closure; // 👈 Le 'use' manquait ici
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Vérifie si connecté
        // 2. Vérifie le rôle avec la méthode isAdmin() du modèle User
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès refusé : Vous n\'avez pas les droits d\'administrateur.');
        }

        return $next($request);
    }
}