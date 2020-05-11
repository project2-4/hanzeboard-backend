<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Staff extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function announcements(): HasMany
    {
        return $this->hasMany(Announcement::class, 'posted_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class, 'recorded_by');
    }
}
