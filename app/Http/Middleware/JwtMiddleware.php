<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            if (!Auth::check()) {
            		return redirect('/login');
            }
            return $next($request);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Token is invalid'], 401);
        }
    }
}