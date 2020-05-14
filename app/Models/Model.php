<?php

namespace App\Models;

use App\Scopes\OrderByScope;
use Illuminate\Database\Eloquent\Model as BaseModel;

/**
 * Class Model
 *
 * @package App\Models
 */
abstract class Model extends BaseModel
{
    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(static::getOrderByScope());
    }

    /**
     * @return \App\Scopes\OrderByScope
     */
    public static function getOrderByScope(): OrderByScope
    {
        return new OrderByScope();
    }
}
