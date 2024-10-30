<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifica se o usuário está autenticado e é administrador
        if (Auth::check() && Auth::user()->isAdmin()) {
            return $next($request); // Permite o acesso à rota
        }

        // Se não for administrador, redireciona para outra página com uma mensagem
        return redirect('dashboard')->with('error', 'Você não tem permissão para acessar esta página.');
    }
}
