<?php

namespace App\Http\Repositories;

use App\Models\Course;
use App\Models\Group;
use App\Models\Page;
use App\Models\Staff;
use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::user()->isStaff()) {
            return $this->model->all()->load('subjects');
        }

        return $this->model->where('is_public', true)->get();
    }

    /**
     * @param  array  $data
     * @param  \Illuminate\Database\Eloquent\Model|null  $model
     *
     * @return bool
     */
    protected function fill(array $data, Model $model = null): bool
    {
        $success = parent::fill(Arr::except($data, ['staff_ids', 'group_ids', 'student_ids', 'subjects']), $model);

        if (!$success) {
            throw new \RuntimeException('Invalid state: could not save course');
        }

        $this->getModel()->users()->sync($this->getUserIds($data));

        if (is_null($model)) {
            $this->createSubjects($data['subjects']);
        }

        return true;
    }

    /**
     * @param  array  $data
     *
     * @return array
     */
    protected function getUserIds(array $data)
    {
        $staff = Staff::with('user')->whereKey($data['staff_ids'])->get();
        $students = Student::with('user')->whereKey($data['student_ids'])->get();
        $groups = Group::with('students.user')->whereKey($data['group_ids'])->get();

        $usersByGroup = [];
        foreach ($groups as $group) {
            $usersByGroup = array_merge($usersByGroup, $group->students->pluck('user.id')->toArray());
        }

        return array_merge(
            $usersByGroup,
            $staff->pluck('user.id')->toArray(),
            $students->pluck('user.id')->toArray(),
            [\auth()->user()->id]
        );
    }

    /**
     * @param  array  $subjects
     */
    protected function createSubjects(array $subjects)
    {
        $this->getModel()->subjects()->createMany(
            array_map(function ($subject) {
                return [
                    'name' => $subject,
                    'page_id' => (Page::create(['name' => $subject, 'content' => '']))->id
                ];
            }, $subjects)
        );
    }
}
