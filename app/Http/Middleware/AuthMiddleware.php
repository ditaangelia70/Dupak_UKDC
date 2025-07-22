<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class AuthMiddleware extends BaseMiddleware
{
    public function handle($request, Closure $next)
    {
        try {
            if ($request->header('Authorization')) {
                JWTAuth::parseToken()->authenticate();
            } elseif ($request->cookie('token')) {
                JWTAuth::setToken($request->cookie('token'))->authenticate();
            } else {
                return redirect('/login');
            }

        } catch (Exception $e) {
            return redirect('/login');
        }

        return $next($request);
    }


}
