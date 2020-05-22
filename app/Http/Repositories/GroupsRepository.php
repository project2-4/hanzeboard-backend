<?php

namespace App\Http\Repositories;

use App\Models\Group;

/**
 * Class GroupsRepository
 *
 * @package App\Http\Repositories
 */
class GroupsRepository extends Repository
{
    /**
     * GroupsRepository constructor.
     *
     * @param  \App\Models\Group  $model
     */
    public function __construct(Group $model)
    {
        parent::__construct($model);
    }
}
