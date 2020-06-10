<?php

namespace App\Http\Middleware;

use App\Traits\RefreshTokens;
use Closure;
use Illuminate\Http\Request;

class ValidRefreshToken
{
    use RefreshTokens;

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$this->validateRefreshToken($request->bearerToken(), $request->cookie('refresh_token'))) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        return $next($request);
    }
}
