<?php

namespace App\Http\Repositories;

use App\Models\Page;

/**
 * Class PageRepository
 *
 * @package App\Http\Repositories
 */
class PagesRepository extends Repository
{
    /**
     * PageRepository constructor.
     *
     * @param  \App\Models\Page  $model
     */
    public function __construct(Page $model)
    {
        parent::__construct($model);
    }
}
