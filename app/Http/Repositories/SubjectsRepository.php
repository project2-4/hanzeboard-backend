<?php

namespace App\Http\Repositories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;

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

    /**
     * @param  \Illuminate\Database\Eloquent\Model  $model
     *
     * @return bool|null
     * @throws \Exception
     */
    protected function destroy(Model $model): ?bool
    {
        $success = (bool) $model->page()->delete();

        if (!$success) {
            throw new \RuntimeException('Invalid state: could not delete a subject page');
        }

        return $model->delete();
    }
}
