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
     * @return JsonResponse
     */
    protected function response(
        $message,
        int $code = 200,
        array $extraLinks = []
    ): JsonResponse {
        if ($message instanceof \Closure) {
            return $this->handleClosure($message);
        }

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

    /**
     * The Closure should create/update/delete a resource (model). This Closure should also
     * return a boolean indicating if the action was performed successfully.
     *
     * When an exception is thrown a 500 request will be generated.
     * When false is returned by either the first or the second Closure a 422 request
     * will be generated.
     * If all goes well, the server will respond with a 200 (OK).
     *
     * @param  \Closure  $closure
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleClosure(\Closure $closure): JsonResponse
    {
        try {
            $success = $closure();
        } catch (\Throwable $e) {
            return $this->response(['success' => false], 500);
        }

        if (!$success) {
            return $this->response(['success' => false], 422);
        }

        return $this->response(['success' => true], 200);
    }
}
