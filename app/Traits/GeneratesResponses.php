<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

/**
 * Trait GeneratesLinks
 *
 * @package App\Traits
 */
trait GeneratesResponses
{
    /**
     * @param $token
     *
     * @return string
     */
    protected function generateRefreshToken($token)
    {
        Cache::put($token, md5($refreshToken = Str::random(256)), config('jwt.refresh_ttl') * 60);

        return $refreshToken;
    }
}
