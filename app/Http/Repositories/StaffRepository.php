<?php

namespace App\Http\Repositories;

use App\Http\Requests\StoreStaff;
use App\Http\Requests\StoreUser;
use App\Models\Staff;
use App\Models\StaffStatus;
use App\Models\Student;
use App\Models\User;
use App\Traits\CreatesUsers;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

/**
 * Class StudentsRepository
 *
 * @package App\Http\Repositories
 */
class StaffRepository extends Repository
{
    use CreatesUsers;

    /**
     * @var User
     */
    private $user;

    /**
     * StaffRepository constructor.
     *
     * @param  \App\Models\Staff  $model
     * @param  \App\Models\User  $user
     */
    public function __construct(Staff $model, User $user)
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
        [$userData, $staffData] = $this->splitData($data);

        $staffStatusData = Arr::only($data, array_keys(StoreStaff::statusRules()));
        $staffData = Arr::except($staffData, array_keys(StoreStaff::statusRules()));
        $staffStatus = $this->createOrUpdateStaffStatus($staffStatusData, $model);
        if (!$model) $staffData['staff_status_id'] = $staffStatus->id;

        $success = parent::fill($staffData, $model);

        if (!$success) {
            throw new \RuntimeException('Invalid state: could not create a staff object');
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
            throw new \RuntimeException('Invalid state: could not delete a staff object');
        }

        return $model->delete();
    }

    /**
     * @return string
     */
    protected function getType()
    {
        return 'staff';
    }

    /**
     * @param array      $staffStatusData
     * @param Model|null $model
     *
     * @return mixed
     */
    private function createOrUpdateStaffStatus(array $staffStatusData, ?Model $model = null): StaffStatus
    {
        if ($model) {
            $staffStatus = StaffStatus::where('id', $model->staff_status_id);
            $staffStatus->update($staffStatusData);
            return $staffStatus->first();
        }

        return StaffStatus::create($staffStatusData);
    }
}
