<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserHasCourses extends Pivot
{
    protected $table = 'user_has_courses';
}
