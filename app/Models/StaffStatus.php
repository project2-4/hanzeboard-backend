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
     * @return HasOne
     */
    public function staff(): HasOne
    {
        return $this->hasOne(Staff::class, 'staff_status_id');
    }
}
