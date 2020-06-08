<?php

namespace App\Http\Repositories;

use App\Models\Page;
use App\Models\PageItem;
use App\Models\Subject;
use App\Traits\ManagesPageItems;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

/**
 * Class SubjectRepository
 *
 * @package App\Http\Repositories
 */
class SubjectsRepository extends Repository
{
    use ManagesPageItems;

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
     * @throws \Exception
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
     * @return \App\Models\Page|mixed
     * @throws \Exception
     */
    protected function savePage(array $data, ?Model $model = null)
    {
        $page = is_null($model) ? new Page() : $model->page;

        $page->fill([
            'name' => $data['page_name'],
            'content' => $data['page_content']
        ])->save();

        if (isset($data['page_items'])) {
            $this->savePageItems($page, $data['page_items']);
        }

        return $page;
    }

    /**
     * @param  \App\Models\Page  $page
     * @param  array  $items
     *
     * @throws \Exception
     */
    protected function savePageItems(Page $page, array $items)
    {
        $pageItems = PageItem::findMany(array_column($items, 'id'))->keyBy('id');
        $existingPageItemIds = $page->items->pluck('id')->toArray();
        $order = 1;

        foreach ($items as $item) {
            if ((bool) $item['deleted']) {
                $this->pageItemDelete($pageItems[$item['id']]);
            } else if (isset($item['id']) && in_array($item['id'], $existingPageItemIds)) {
                $this->pageItemUpdate($pageItems[$item['id']], $item, $order++);
            } else {
                $this->pageItemCreate($page, $item, $order++);
            }
        }
    }
}
