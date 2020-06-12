<?php

namespace App\Http\Repositories;

use App\Models\Submission;

/**
 * Class SubmissionsRepository
 *
 * @package App\Http\Repositories
 */
class SubmissionsRepository extends Repository
{
    /**
     * SubmissionsRepository constructor.
     *
     * @param  \App\Models\Submission  $model
     */
    public function __construct(Submission $model)
    {
        parent::__construct($model);
    }
}
