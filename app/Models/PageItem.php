<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageItem extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'page_id');
    }
}
