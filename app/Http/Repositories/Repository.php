<?php

namespace App\Http\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class Repository
 *
 * @package RoyVoetman\Repositories
 */
abstract class Repository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * Repository constructor.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     */
    protected function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param  array  $data
     * @param  \Illuminate\Database\Eloquent\Model|null  $model
     *
     * @return bool
     * @throws \Throwable
     */
    public function save(array $data, Model $model = null): bool
    {
        return DB::transaction(function () use ($data, $model) {
            return $this->fill($data, $model);
        });
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Model  $model
     *
     * @return bool
     * @throws \Throwable
     */
    public function delete(Model $model): bool
    {
        return DB::transaction(function () use ($model) {
            return (bool) $this->destroy($model);
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * @param  array  $data
     * @param  \Illuminate\Database\Eloquent\Model|null  $model
     *
     * @return bool
     */
    protected function fill(array $data, Model $model = null): bool
    {
        $this->model = $model ?? $this->model->newInstance();

        return $this->model->fill($data)->save();
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Model  $model
     *
     * @return bool|null
     * @throws \Exception
     */
    protected function destroy(Model $model): ?bool
    {
        return $model->delete();
    }
}
