<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class OrderByScope implements Scope
{
    /**
     * @var string
     */
    protected $orderBy;

    /**
     * @var bool
     */
    protected $orderDirection;

    /**
     * OrderByScope constructor.
     *
     * @param  string  $orderBy
     * @param  string  $orderDirection
     */
    public function __construct($orderBy = 'id', $orderDirection = 'ASC')
    {
        $this->orderBy = $orderBy;
        $this->orderDirection = $orderDirection;
    }

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->orderBy($this->orderBy, $this->orderDirection);
    }
}
