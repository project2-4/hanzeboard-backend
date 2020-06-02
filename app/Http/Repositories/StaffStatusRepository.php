<?php

namespace App\Http\Repositories;

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
 * Class StaffStatusRepository
 *
 * @package App\Http\Repositories
 */
class StaffStatusRepository extends Repository
{
    /**
     * StaffStatusRepository constructor.
     *
     * @param StaffStatus $model
     */
    public function __construct(StaffStatus $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $data
     * @param Staff $staff
     *
     * @return array
     */
    public function update(array $data, Staff $staff) {
        return [$staff->status->update($data), $staff->id];
    }
}
