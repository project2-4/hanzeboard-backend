<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

/**
 * Trait GeneratesLinks
 *
 * @package App\Traits
 */
trait RefreshTokens
{
    /**
     * @param $accessToken
     *
     * @return string
     */
    protected function generateRefreshToken($accessToken): string
    {
        Cache::put(md5($accessToken), md5($refreshToken = Str::random(256)), $this->getRefreshTokenTTL() * 60);

        return $refreshToken;
    }

    /**
     * @param $accessToken
     * @param $refreshToken
     *
     * @return bool
     */
    protected function validateRefreshToken(?string $accessToken, ?string $refreshToken): bool
    {
        if (is_null($accessToken) ||
            is_null($refreshToken) ||
            is_null($cachedRefreshToken = Cache::get(md5($accessToken)))
        ) {
            return false;
        }

        if ($cachedRefreshToken !== md5($refreshToken)) {
            return false;
        }

        return true;
    }

    /**
     * TTL in minutes
     *
     * @return int
     */
    protected function getRefreshTokenTTL(): int
    {
        return config('jwt.refresh_ttl') * 60;
    }
}
