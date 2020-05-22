<?php

namespace App\Http\Repositories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Collection;

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

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPublicCourses(): Collection
    {
        return $this->model->where('is_public', true)->get();
    }
}