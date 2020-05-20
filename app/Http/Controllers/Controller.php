<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /** @var array ROUTES */
    const ROUTES = [
        'index' => 'GET',
        'show' => 'GET',
        'create' => 'GET',
        'edit' => 'PUT',
        'destroy' => 'DESTROY'
    ];

    /** @var array ROUTES_WITH_ID */
    const ROUTES_WITH_ID = ['show', 'edit', 'destroy'];

    /**
     * @param string $message
     * @param int $code
     * @param array $extraLinks
     *
     * @return JsonResponse
     */
    protected function response(
        string $message,
        int $code = 200,
        array $extraLinks = []
    ): JsonResponse {
        $links = $this->getLinks();

        if (count($extraLinks) > 0 ) {
            foreach ($extraLinks as $route => $method) {
                $links[] = $this->addLink($route, $method);
            }
        }

        $responseObject = [
            'message' => $message,
            'code' => $code,
            'links' => $links
        ];

        return response()->json($responseObject, $code);
    }

    /**
     * @param string $url
     * @param string $method
     *
     * @return array
     */
    protected function addLink(
        string $url,
        string $method = 'GET'
    ): array {
        return [
            'url' => $url,
            'method' => $method
        ];
    }

    /**
     * @return array
     */
    private function getLinks(): array
    {
        $url = URL::to('/') . Route::getCurrentRoute()->getCompiled()->getStaticPrefix();
        $links = [];

        foreach (self::ROUTES as $route => $method) {
            $newLink = [
                'url' => $url . '/' . $route,
                'method' => $method
            ];

            if (in_array($route, self::ROUTES_WITH_ID)) {
                $newLink['url'] .= '/' . implode("", Route::getCurrentRoute()->parameters());
            }

            $links[] = $newLink;
        }

        return $links;
    }
}
