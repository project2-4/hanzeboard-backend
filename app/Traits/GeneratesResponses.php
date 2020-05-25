<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

/**
 * Trait GeneratesLinks
 *
 * @package App\Traits
 */
trait GeneratesResponses
{
    use HasLinks;

    /**
     * @param $message
     * @param  int  $code
     * @param  array  $extraLinks
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function response(
        $message,
        int $code = 200,
        array $extraLinks = []
    ): JsonResponse {
        $links = $this->getLinks();

        if (count($extraLinks) > 0) {
            foreach ($extraLinks as $route => $method) {
                $links[] = $this->addLink($route, $method);
            }
        }

        return response()->json([
            'message' => $message,
            'code'    => $code,
            'links'   => $links
        ], $code);
    }
}
