<?php

use Illuminate\Database\Seeder;

class PageItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Page::all()->each(function ($page) {
            $page->items()->createMany(
                factory(App\Models\PageItem::class, 5)->make([
                    'page_id' => $page->id
                ])->toArray()
            );
        });
    }
}
