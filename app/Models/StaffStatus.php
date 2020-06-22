<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @method static find(int $id)
 * @method static where(string $string, $id)
 * @method static create(array $staffStatusData)
 */
class StaffStatus extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'until' => 'datetime',
    ];

    /**
     * @var string[]
     */
    protected $appends = ['until_formatted'];

    /**
     * @return string
     */
    public function getUntilFormattedAttribute(): string
    {
        return $this->until->format('d-m-Y');
    }

    /**
     * @return HasOne
     */
    public function staff(): HasOne
    {
        return $this->hasOne(Staff::class, 'staff_status_id');
    }
}
