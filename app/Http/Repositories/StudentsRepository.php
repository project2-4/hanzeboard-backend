<?php

namespace App\Http\Repositories;

use App\Models\Student;
use App\Models\User;
use App\Traits\CreatesUsers;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentsRepository
 *
 * @package App\Http\Repositories
 */
class StudentsRepository extends Repository
{
    use CreatesUsers;

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
        return $this->getModel()->with('user')->get();
    }

    /**
     * @param  array  $data
     * @param  \Illuminate\Database\Eloquent\Model|null  $model
     *
     * @return bool
     */
    protected function fill(array $data, Model $model = null): bool
    {
        [$userData, $studentData] = $this->splitData($data);

        $success = parent::fill($studentData, $model);

        if (!$success) {
            throw new \RuntimeException('Invalid state: could not create a student object');
        }

        if (is_null($model)) {
            return $this->createNewUser($userData, $this->getModel()->id);
        }

        return $model->user->update($userData);
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Model  $model
     *
     * @return bool|null
     * @throws \Exception
     */
    protected function destroy(Model $model): ?bool
    {
        $success = (bool) $model->user()->delete();

        if (!$success) {
            throw new \RuntimeException('Invalid state: could not delete a student object');
        }

        return $model->delete();
    }

    /**
     * @return string
     */
    protected function getType()
    {
        return 'student';
    }
}
