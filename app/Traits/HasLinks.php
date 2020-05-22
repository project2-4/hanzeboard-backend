<?php

namespace App\Traits;

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
        $url = URL::to('/') . Route::getCurrentRoute()->getCompiled()->getStaticPrefix();
        $links = [];

        foreach ($this->getRoutes() as $route => $method) {
            $newLink = [
                'url' => $url . '/' . $route,
                'method' => $method
            ];

            if (in_array($route, $this->getRoutesWithId())) {
                $newLink['url'] .= '/' . implode("", Route::getCurrentRoute()->parameters());
            }

            $links[] = $newLink;
        }

        return $links;
    }

    /**
     * @return array|string[]
     */
    public function getRoutes(): array
    {
        return  [
            'index' => 'GET',
            'show' => 'GET',
            'create' => 'GET',
            'edit' => 'GET',
            'destroy' => 'DESTROY'
        ];
    }

    public function getRoutesWithId(): array
    {
        return ['show', 'edit', 'destroy'];
    }
}
