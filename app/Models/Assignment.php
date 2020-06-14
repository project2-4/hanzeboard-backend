<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static find(int $id)
 */
class Assignment extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'deadline' => 'datetime',
    ];

    /**
     * @var string[]
     */
    protected $hidden = ['grades'];

    /**
     * @var string[]
     */
    protected $appends = ['avg_grade', 'passed', 'total_submissions', 'grade_overview'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class, 'assignment_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class, 'assignment_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    /**
     * @return float
     */
    public function getAvgGradeAttribute(): float
    {
        return $this->grades->avg('grade') ?? 0.0;
    }

    /**
     * @return int
     */
    public function getPassedAttribute(): int
    {
        return $this->grades->filter(function ($value) {
            return $value['grade'] >= 5.5;
        })->count();
    }

    /**
     * @return int
     */
    public function getTotalSubmissionsAttribute(): int
    {
        return $this->grades->count();
    }

    /**
     * @return array
     */
    public function getGradeOverviewAttribute(): array
    {
        $overview = [];
        for ($i = 1; $i <= 10; $i++) {
            $overview[$i] = 0;
        }

        $this->grades->each(function ($item) use(&$overview) {
            $overview[floor($item['grade'])]++;
        });

        return $overview;
    }
}
