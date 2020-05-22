<?php

namespace App\Http\Repositories;

use App\Models\Course;

/**
 * Class CoursesRepository
 *
 * @package App\Http\Repositories
 */
class CoursesRepository extends Repository
{
    /**
     * CoursesRepository constructor.
     *
     * @param  \App\Models\Course  $model
     */
    public function __construct(Course $model)
    {
        parent::__construct($model);
    }
}
