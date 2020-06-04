<?php

namespace App\Http\Repositories;

use App\Models\Assignment;
use App\Models\Grade;
use App\Models\Staff;
use App\Models\Student;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use RuntimeException;

/**
 * Class StudentsRepository
 *
 * @package App\Http\Repositories
 */
class GradesRepository extends Repository
{
    /**
     * @var User
     */
    private $user;

    /**
     * StudentsRepository constructor.
     *
     * @param Grade $model
     * @param User $user
     */
    public function __construct(Grade $model, User $user)
    {
        parent::__construct($model);

        $this->user = $user;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->getModel()->with('recorder.user')->get();
    }

    /**
     * @param Student $student
     * @param Assignment $assignment
     * @param Staff $assigner
     * @param float $number
     *
     * @return Grade
     */
    public function newGrade(
        Student $student,
        Assignment $assignment,
        Staff $assigner,
        float $number
    ): Grade {
        $grade = new Grade();
        $grade->student_id = $student->id;
        $grade->recorded_by = $assigner->id;
        $grade->assignment_id = $assignment->id;
        $grade->grade = $number;

        try {
            $grade->saveOrFail();
        } catch (\Throwable $e) {
            dd($e);
        }

        return $grade;
    }


    /**
     * @param Model $model
     *
     * @return bool|null
     * @throws Exception
     */
    protected function destroy(Model $model): ?bool
    {
        $success = (bool) $model->delete();

        if (!$success) {
            throw new RuntimeException('Invalid state: could not delete a student object');
        }

        return $model->delete();
    }

    /**
     * @return string
     */
    protected function getType()
    {
        return 'grade';
    }
}
