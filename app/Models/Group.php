<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(Student::class, 'group_id');
    }
}
