<?php

namespace App\Http\Repositories;

use App\Models\Assignment;

/**
 * Class AssignmentsRepository
 *
 * @package App\Http\Repositories
 */
class AssignmentsRepository extends Repository
{
    /**
     * AssignmentsRepository constructor.
     *
     * @param  \App\Models\Assignment  $model
     */
    public function __construct(Assignment $model)
    {
        parent::__construct($model);
    }
}
