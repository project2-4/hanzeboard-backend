<?php

namespace App\Http\Repositories;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Throwable;

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
     * @param Model $model
     */
    protected function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param  array  $data
     * @param Model|null  $model
     *
     * @return array
     * @throws Throwable
     */
    public function save(array $data, Model $model = null): array
    {
        return [DB::transaction(function () use ($data, $model) {
            return $this->fill($data, $model);
        }), $this->getModel()->id];
    }

    /**
     * @param Model $model
     *
     * @return bool
     * @throws Throwable
     */
    public function delete(Model $model): bool
    {
        return DB::transaction(function () use ($model) {
            return (bool) $this->destroy($model);
        });
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * @param  array  $data
     * @param Model|null  $model
     *
     * @return bool
     */
    protected function fill(array $data, Model $model = null): bool
    {
        $this->model = $model ?? $this->model->newInstance();

        return $this->model->fill($data)->save();
    }

    /**
     * @param Model $model
     *
     * @return bool|null
     * @throws Exception
     */
    protected function destroy(Model $model): ?bool
    {
        return $model->delete();
    }
}
