<?php

namespace App\Http\Repositories;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class StudentsRepository
 *
 * @package App\Http\Repositories
 */
class StudentsRepository extends Repository
{
    /**
     * @var User
     */
    private $user;

    /**
     * StudentsRepository constructor.
     *
     * @param  \App\Models\Student  $model
     * @param  \App\Models\User  $user
     */
    public function __construct(Student $model, User $user)
    {
        parent::__construct($model);

        $this->user = $user;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(): Collection
    {
        return $this->user->all()->where('profile_type', '=', 'student');
    }
}
