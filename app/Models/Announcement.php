<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Announcement extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function poster(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'posted_by');
    }
}
