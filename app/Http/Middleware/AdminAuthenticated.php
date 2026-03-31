<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            $request->session()->put('admin_intended', URL::full());
            return redirect()->route('admin.login');
        }

        if (!Auth::user()?->is_admin) {
            abort(403, 'Acesso permitido apenas para administradores.');
        }

        return $next($request);
    }
}
