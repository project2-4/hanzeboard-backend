<?php

namespace App\Http\Repositories;

use App\Models\Subject;

/**
 * Class SubjectRepository
 *
 * @package App\Http\Repositories
 */
class SubjectsRepository extends Repository
{
    /**
     * SubjectRepository constructor.
     *
     * @param  \App\Models\Subject  $model
     */
    public function __construct(Subject $model)
    {
        parent::__construct($model);
    }
}
