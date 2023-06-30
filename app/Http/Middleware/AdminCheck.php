<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;

class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $guard = $request->expectsJson() ? 'api' : 'web';
        if(auth()->id() != 1) {
            if($guard == 'web') {
                Auth::logout();
                return redirect('login')->withErrors(['password' => 'error']);
            }
            return new Response('Permission Denied', 401);
        }
        return $next($request);
    }
}
