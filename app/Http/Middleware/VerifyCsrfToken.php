<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\TokenMismatchException;

class VerifyCsrfToken
{
    public function handle($request, Closure $next)
    {
        if ($request->isMethod('post') || $request->isMethod('put') || $request->isMethod('delete')) {
            if (session('_token') !== $request->input('_token')) {
                throw new TokenMismatchException;
            }
        }
        return $next($request);
    }
}
