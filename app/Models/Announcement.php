<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static find(int $id)
 */
class Announcement extends Model
{
    /**
     * @var string[]
     */
    protected $appends = ['created_at_formatted'];

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

    /**
     * @return string
     */
    public function getCreatedAtFormattedAttribute(): string
    {
        return $this->created_at->format('Y-m-d H:i:s');
    }
}
