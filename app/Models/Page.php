<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static find(int $id)
 */
class Page extends Model
{
    /**
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(PageItem::class, 'page_id')
            ->orderBy('order');
    }

    /**
     * @return HasOne
     */
    public function subject(): HasOne
    {
        return $this->hasOne(Subject::class, 'page_id');
    }

    /**
     * Get the phone record associated with the user.
     */
    public function children(): HasMany
    {
        return $this->hasMany(Page::class, 'parent_page_id');
    }

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'parent_page_id');
    }
}
