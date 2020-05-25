<?php

namespace App\Http\Repositories;

use App\Http\Requests\StoreUser;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

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
     * @param  array  $data
     * @param  \Illuminate\Database\Eloquent\Model|null  $model
     *
     * @return bool
     */
    protected function fill(array $data, Model $model = null): bool
    {
        $userKeys = array_keys(StoreUser::rules());

        $userData = Arr::only($data, $userKeys);
        $studentData = Arr::except($data, $userKeys);

        $success = parent::fill($studentData);

        if (!$success) {
            throw new \RuntimeException('Invalid state: could not create a student object');
        }

        if (is_null($model)) {
            return $this->createNewUser($userData);
        }

        return $model->user->update($userData);
    }

    /**
     * @param  array  $data
     *
     * @return bool
     */
    protected function createNewUser(array $data) : bool
    {
        $user = $this->user->newInstance();

        return $user->fill(array_merge($data, [
            'profile_type' => 'student',
            'profile_id' => $this->getModel()->id
        ]))->save();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(): Collection
    {
        return $this->user->all()->where('profile_type', '=', 'student');
    }
}
