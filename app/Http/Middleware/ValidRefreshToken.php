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
            return abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
