<?php

namespace App\Http\Repositories;

use App\Models\Announcement;

/**
 * Class AnnouncementsRepository
 *
 * @package App\Repositories
 */
class AnnouncementsRepository extends Repository
{
    /**
     * AnnouncementsRepository constructor.
     *
     * @param  \App\Models\Announcement  $model
     */
    public function __construct(Announcement $model)
    {
        parent::__construct($model);
    }
}
