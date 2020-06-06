<?php

namespace App\Http\Repositories;

use App\Models\Page;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

/**
 * Class SubjectRepository
 *
 * @package App\Http\Repositories
 */
class SubjectsRepository extends Repository
{
    /**
     * SubjectRepository constructor.
     *
     * @param  \App\Models\Subject  $model
     */
    public function __construct(Subject $model)
    {
        parent::__construct($model);
    }

    /**
     * @param  array  $data
     * @param  \Illuminate\Database\Eloquent\Model|null  $model
     *
     * @return bool
     */
    protected function fill(array $data, Model $model = null): bool
    {
        $page = $this->savePage($data, $model);

        $subjectData = Arr::except($data, ['page_name', 'page_content', 'page_items']);

        return parent::fill(array_merge($subjectData, [
            'page_id' => $page->id
        ]), $model);
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Model  $model
     *
     * @return bool|null
     * @throws \Exception
     */
    protected function destroy(Model $model): ?bool
    {
        $page = $model->page();
        $success = $model->delete();

        if (!$success) {
            throw new \RuntimeException('Invalid state: could not delete subject');
        }

        return (bool) $page->delete();
    }

    /**
     * @param  array  $data
     * @param  \Illuminate\Database\Eloquent\Model|null  $model
     *
     * @return \App\Models\Page
     */
    protected function savePage(array $data, ?Model $model = null)
    {
        $page = is_null($model) ? new Page() : $model->page;

        $page->fill([
            'name' => $data['page_name'],
            'content' => $data['page_content']
        ])->save();

        $this->savePageItems($page, $data['page_items']);

        return $page;
    }

    /**
     * @param  \App\Models\Page  $page
     * @param  array  $items
     */
    protected function savePageItems(Page $page, array $items)
    {
        // Delete all previous items
        $page->items()->delete();

        // Create new items based on data
        $page->items()->createMany(
            array_map(function ($item, $iteration) use ($page) {
                return [
                    'title' => $item['title'],
                    'content' => $item['content'],
                    'type' => $item['type'],
                    'order' => $iteration
                ];
            }, $items, range(1, count($items)))
        );
    }
}
