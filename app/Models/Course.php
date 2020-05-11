<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages(): HasMany
    {
        return $this->hasMany(Page::class, 'course_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function announcements(): HasMany
    {
        return $this->hasMany(Announcement::class, 'course_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subjects(): HasMany
    {
        return $this->hasMany(Subject::class, 'course_id');
    }
}
