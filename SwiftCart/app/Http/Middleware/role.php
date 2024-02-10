<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Route;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!((Route::is('admin.*') && auth()->user()->role == 'admin')
            || (Route::is('vendor.*') && auth()->user()->role == 'vendor')))
        {
              abort(403);

        }
        return $next($request);
    }
}
