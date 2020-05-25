<?php

namespace App\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

/**
 * Trait GeneratesLinks
 *
 * @package App\Traits
 */
trait HasLinks
{
    /**
     * @param  string  $url
     * @param  string  $method
     *
     * @return array
     */
    protected function addLink(
        string $url,
        string $method = 'GET'
    ): array {
        return [
            'url'    => $url,
            'method' => $method
        ];
    }

    /**
     * @return array
     */
    private function getLinks(): array
    {
        $links = [];

        if (count($segments = explode('.', Route::currentRouteName())) === 2) {
            $resource = $segments[0];
            $currentAction = $segments[1];

            $routes = $this->getDefaultRoutes();

            if (!$this->actionRequiresId($currentAction)) {
                $routes = Arr::except($routes, $this->getActionsWithId());
            }

            foreach ($routes as $action => $method) {
                if ($currentAction === $action) {
                    continue;
                }

                $parameters = Route::getCurrentRoute()->parameters();

                if (!$this->actionRequiresId($action) && $this->actionRequiresId($currentAction)) {
                    end($parameters);
                    Arr::forget($parameters, key($parameters));
                }

                $url = route("{$resource}.{$action}", $parameters);

                $links[$action] = ['url' => $url, 'method' => $method];
            }
        }

        return $links;
    }

    /**
     * @return array|\string[][]
     */
    public function getDefaultRoutes(): array
    {
        return  [
            'index' => 'GET',
            'store' => 'POST',
            'destroy' => 'DELETE',
            'show' => 'GET',
            'update' => 'PUT'
        ];
    }

    public function actionRequiresId(string $action)
    {
        return in_array($action, $this->getActionsWithId());
    }

    /**
     * @return array|\string[][]
     */
    private function getActionsWithId(): array
    {
        return ['destroy', 'show', 'update'];
    }
}
