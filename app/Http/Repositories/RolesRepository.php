<?php

namespace App\Http\Repositories;

use App\Models\Role;

/**
 * Class RoleRepository
 *
 * @package App\Http\Repositories
 */
class RolesRepository extends Repository
{
    /**
     * RoleRepository constructor.
     *
     * @param  \App\Models\Role  $model
     */
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }
}
