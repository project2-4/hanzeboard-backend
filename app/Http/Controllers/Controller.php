<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Repository;
use App\Traits\GeneratesResponses;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class Controller
 *
 * @package App\Http\Controllers
 */
abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, GeneratesResponses;

    /**
     * @var \App\Http\Repositories\Repository
     */
    protected $repository;

    /**
     * Controller constructor.
     *
     * @param  \App\Http\Repositories\Repository|null  $repository
     */
    public function __construct(?Repository $repository = null)
    {
        $this->repository = $repository;
    }

    /**
     * @param  bool  $success
     *
     * @return int
     */
    public function getStatusCode(bool $success): int
    {
        if (!$success) {
            return 400;
        }

        switch (request()->method()) {
            case 'POST':
                return 201;
            case 'PUT':
            case 'PATCH':
            case 'DELETE':
                return 204;
            default:
                return 200;
        }
    }
}
