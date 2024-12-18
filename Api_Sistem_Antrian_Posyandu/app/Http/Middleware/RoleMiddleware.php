<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
    {
        if (!auth()->check()) {
            return redirect(route('login'));
        }
    
        $user = auth()->user();
    
        if ($user->role != $role) {
            if ($user->role == 'admin') {
                return redirect(route('dashboard'));
            } else {
                return "<h1>LAYANAN KHUSUS API</h1>";
            }
        }
    
        return $next($request);
    }
    
}
