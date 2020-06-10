<?php

namespace App\Traits;

use App\Models\Page;
use App\Models\PageItem;
use Illuminate\Support\Facades\Storage;

/**
 * Trait ManagesPageItems
 *
 * @package App\Traits
 */
trait ManagesPageItems
{
    /**
     * @param  \App\Models\Page  $page
     * @param  array  $data
     * @param  int  $order
     */
    protected function pageItemCreate(Page $page, array $data, int $order)
    {
        // If page item type equals files, store files on filesystem
        if ($data['type'] === 'files') {
            $data['content'] = $this->storeFiles($data['files'], []);
        }

        // Create database record
        $page->items()->create([
            'title' => $data['title'],
            'content' => json_encode($data['content']),
            'type' => $data['type'],
            'order' => $order
        ]);
    }

    /**
     * @param  \App\Models\PageItem  $pageItem
     * @param  array  $data
     * @param  int  $order
     */
    protected function pageItemUpdate(PageItem $pageItem, array $data, int $order)
    {
        // If page item type equals files, update file on filesystem
        if ($pageItem->type === 'files') {
            $data[ 'content' ] = json_decode($data[ 'content' ], true);

            $this->removeFiles($pageItem, $data[ 'content' ]);
            $data[ 'content' ] = $this->storeFiles($data[ 'files' ], $data[ 'content' ]);
        }

        // Update database record
        $pageItem->update([
            'title' => $data['title'],
            'content' => json_encode($data['content']),
            'type' => $data['type'],
            'order' => $order
        ]);
    }

    /**
     * @param  \App\Models\PageItem  $pageItem
     *
     * @throws \Exception
     */
    protected function pageItemDelete(PageItem $pageItem)
    {
        // Remove files if type equals 'files'
        if ($pageItem->type === 'files') {
            $files = array_keys(json_decode($pageItem->content, true));

            foreach ($files as $file) {
                Storage::delete($file);
            }
        }

        // Delete database record
        $pageItem->delete();
    }

    /**
     * Remove all files for the filesystem that are not present in the $newFiles array.
     *
     * @param  \App\Models\PageItem  $pageItem
     * @param  array  $newFiles
     */
    private function removeFiles(PageItem $pageItem, array $newFiles)
    {
        $oldFiles = array_keys(json_decode($pageItem->content, true));
        $newFiles = array_keys($newFiles);

        foreach ($oldFiles as $oldFile) {
            if (!in_array($oldFile, $newFiles)) {
                Storage::delete($oldFile);
            }
        }
    }

    /**
     * Store the provided files and update the $content array
     *
     * @param  array  $files
     * @param  array  $content
     *
     * @return array
     */
    private function storeFiles(array $files, array $content)
    {
        foreach ($files as $file) {
            $path = str_replace('public/', '', $file->store('public'));
            $content[$path] = $file->getClientOriginalName();
        }

        return $content;
    }
}
